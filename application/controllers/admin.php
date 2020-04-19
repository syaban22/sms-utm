<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'User Lists';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['level'] = $this->db->get('user_level')->result_array();
		$data['profil'] = $this->db->get_where('admin', ['username' => $data['user']['id']])->row_array();
		$this->load->model('user_model', 'userM');
		//$data['user'] = $this->db->from('user');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('username', $data['keyword']);
		$this->db->from('user');
		$this->db->where('level_id != 1 AND level_id != 2');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/admin/getUserlist';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}
		$data['users'] = $this->userM->getUsers($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id']);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');
	}

	function daftarDosen()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Dosen';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['profil'] = $this->db->get_where('admin', ['username' => $userid['id']])->row_array();
		$data['prodi'] = $this->db->get('prodi')->result_array();
		$data['username'] = $this->db->get_where('user', ['level_id' => '3'])->result_array();
		$this->load->model('dosen_model', 'dosenM');

		// searching
		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}
		$this->db->like('nama', $data['keyword']);
		$this->db->from('dosen');
		// page
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/admin/daftarDosen';
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}
		$data['dosen'] = $this->dosenM->getDosen($config['per_page'], $data['start'], $data['keyword']);

		$this->form_validation->set_rules('nip', 'nipdosen', 'required');
		$this->form_validation->set_rules('nama', 'namadosen', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/daftarDosen', $data);
			$this->load->view('template/footer');
		} else {
			if ($this->db->get_where('user', ['username' => $this->input->post('nip')])->row_array() == null) {
				$usr = [
					'username' => $this->input->post('nip'),
					'password' => password_hash($this->input->post('nip'), PASSWORD_DEFAULT),
					'level_id' => 3
				];
				$this->db->insert('user', $usr);
			}
			if ($this->db->get_where('dosen', ['nip' => $this->input->post('nip')])->row_array() == null) {
				$data = [
					'nip' => $this->input->post('nip'),
					'nama' => $this->input->post('nama'),
					'gambar' => "default.jpg",
					'username' => $this->db->get_where('user', ['username' =>$this->input->post('nip')])->row_array()['id'],
					'prodi' =>  $this->db->get_where('admin',['username' => $userid['id']])->row_array()['prodi'],
					'email' => $this->input->post('email'),
					'tgl_buat' => time()
				];
				$this->db->insert('dosen', $data);
				$this->session->set_flashdata('pesan', '1 User Dosen berhasil ditambahkan');
			}else{
				// gagal karena nip sudah digunakan
			}
			redirect('admin/daftarDosen');
		}
	}

	public function updateDosen($id)
	{
		$this->form_validation->set_rules('nip', 'nip', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');

		$data = array(
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama')
		);

		$this->db->where('nip', $id);
		$this->db->update('dosen', $data);
		$this->session->set_flashdata('pesan', 'Edit data user Dosen berhasil');
		redirect('admin/daftarDosen');
	}

	public function deleteDosen($id)
	{
		$this->db->delete('dosen', array('nip' => $id));
		$this->session->set_flashdata('pesan', '1 User Dosen berhasil dihapus');
		redirect('admin/daftarDosen');
	}

	function daftarMahasiswa()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Mahasiswa';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['profil'] = $this->db->get_where('admin', ['username' => $userid['id']])->row_array();

		$this->load->model('mahasiswa_model', 'mahasiswaM');
		$data['prodi'] = $this->db->get('prodi')->result_array();
		$data['username'] = $this->db->get_where('user', ['level_id' => '4'])->result_array();
		//$data['user'] = $this->db->from('user');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nama', $data['keyword']);
		$this->db->from('mahasiswa');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/admin/daftarMahasiswa';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['mahasiswa'] = $this->mahasiswaM->getMahasiswa($config['per_page'], $data['start'], $data['keyword']);
		// $data['userDosen'] = $this->dosenM->getUserDosen();

		$this->form_validation->set_rules('nim', 'nimmahasiswa', 'required');
		$this->form_validation->set_rules('nama', 'namamahasiswa', 'required');

		// nanti di cek
		if ($this->input->post('username') == NULL) {
			$username = 'NULL';
		} else {
			$username = $this->input->post('username');
		}
		// 
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/daftarMahasiswa', $data);
			$this->load->view('template/footer');
		} else {
			if (substr($this->input->post('nim'), 3, 4) == $this->db->get_where('admin', ['username' => $userid['id']])->row_array()['prodi']) {
				if ($this->db->get_where('user', ['username' => $this->input->post('nim')])->row_array() == null) {
					$data = [
						'username' => $this->input->post('nim'),
						'password' => password_hash($this->input->post('nim'), PASSWORD_DEFAULT),
						'level_id' => 4
					];
					$this->db->insert('user', $data);
				}
				if ($this->db->get_where('mahasiswa', ['nim' => $this->input->post('nim')])->row_array() == null) {
					$data2 = [
						'nim' => $this->input->post('nim'),
						'nama' => $this->input->post('nama'),
						'gambar' => 'default.jpg',
						'prodi' => substr($this->input->post('nim'), 3, 4),
						'email' => $this->input->post('email'),
						'username' => $this->db->get_where('user', ['username' => $this->input->post('nim')])->row_array()['id'],
						'tgl_buat' => time()
					];
					$this->db->insert('mahasiswa', $data2);
					$this->session->set_flashdata('pesan', '1 User Mahasiswa berhasil ditambahkan');
				}else{
					// gagal karena nim digunakan
				}
			} else {
				// ditambahkan flashdata untuk data gagal diinputkan karena prodi tidak sesuai
			}
			redirect('admin/daftarMahasiswa');
		}
	}

	public function updateMahasiswa($id)
	{
		if (substr($this->input->post('nim'), 3, 4) == $this->db->get_where('admin', ['username' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()['id']])->row_array()['prodi']) {
			$this->form_validation->set_rules('nim', 'nim', 'required');
			$this->form_validation->set_rules('nama', 'nama', 'required');
			if ($this->db->get_where('user', ['username' => $this->input->post('nim')])->row_array() == null) {
				$data = array(
					'username' => $this->input->post('nim'),
					'password' => password_hash($this->input->post('nim'), PASSWORD_DEFAULT),
					'level_id' => 4
				);
				$this->db->insert('user', $data);
			}
			if ($this->db->get_where('mahasiswa', ['nim' => $this->input->post('nim')])->row_array() == null || $this->input->post('nim')==$id) {
				$data = array(
					'nim' => $this->input->post('nim'),
					'nama' => $this->input->post('nama'),
					'username' => $this->db->get_where('user', ['username' => $this->input->post('nim')])->row_array()['id']
				);
				$this->db->where('nim', $id);
				$this->db->update('mahasiswa', $data);
				$this->session->set_flashdata('pesan', 'Edit data Mahasiswa berhasil');
				if ($this->input->post('nim')!=$id){
					$this->db->delete('user', array('username' => $id));
				}
			}else{
				// gagal nim telah digunakan
			}
		}else{
			// gagal prodi tidak sesuai
		}
		redirect('admin/daftarMahasiswa');
	}

	public function deleteMahasiswa($id)
	{
		$this->db->delete('mahasiswa', array('nim' => $id));
		$this->session->set_flashdata('pesan', '1 user Mahasiswa berhasil dihapus');
		redirect('admin/daftarMahasiswa');
	}

	public function daftarSkripsi()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Skripsi';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['profil'] = $this->db->get_where('admin', ['username' => $userid['id']])->row_array();
		$this->load->model('skripsi_model', 'skripsiM');
		$data['level'] = $this->db->get('user_level')->result_array();
		//$data['user'] = $this->db->from('user');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nim', $data['keyword']);
		$this->db->from('skripsi');
		// $this->db->where('level_id != 1 AND level_id != 2');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/admin/daftarSkripsi';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['skripsi'] = $this->skripsiM->getSkripsi($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id']);
		$data['penguji'] = $this->skripsiM->getPenguji();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/daftarSkripsi', $data);
		$this->load->view('template/footer');
	}

	public function updatePenguji($id)
	{
		if ($this->input->post('penguji3') != "") {
			$data = array(
				'dosen_uji3' => $this->input->post('penguji3')
			);
			$this->db->where('id', $id);
			$this->db->update('skripsi', $data);
			$this->session->set_flashdata('pesan', 'Dosen penguji berhasil ditambahkan');
		}
		if ($this->input->post('penguji2') != "") {
			$data = array(
				'dosen_uji2' => $this->input->post('penguji2')
			);
			$this->db->where('id', $id);
			$this->db->update('skripsi', $data);
			$this->session->set_flashdata('pesan', 'Dosen penguji berhasil ditambahkan');
		}
		if ($this->input->post('penguji1') != "") {
			$data = array(
				'dosen_uji1' => $this->input->post('penguji1')
			);
			$this->db->where('id', $id);
			$this->db->update('skripsi', $data);
			$this->session->set_flashdata('pesan', 'Dosen penguji berhasil ditambahkan');
		}
		redirect('admin/daftarSkripsi');
	}

	public function level()
	{
		$data['judul'] = 'Level';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['level'] = $this->db->get('user_level')->result_array();

		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/level', $data);
			$this->load->view('template/footer');
		} else {
			$this->db->insert('user_level', ['level' => $this->input->post('level')]);
			$this->session->set_flashdata('pesan', 'Level baru berhasil ditambahkan');
			redirect('admin/level');
		}
	}

	public function update($id)
	{
		$data = array(
			'level' => $this->input->post('levelU')
		);

		$this->db->where('id', $id);
		$this->db->update('user_level', $data);
		$this->session->set_flashdata('pesan', 'Edit data Level');
		redirect('admin/level');
	}

	public function delete($id)
	{
		$this->db->delete('user_level', array('id' => $id));
		$this->session->set_flashdata('pesan', 'Level berhasil dihapus');
		redirect('admin/level');
	}

	public function levelakses($id)
	{
		$data['judul'] = 'Level Akses';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['level'] = $this->db->get_where('user_level', ['id' => $id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/level-akses', $data);
		$this->load->view('template/footer');
	}

	function get_file()
	{
		$id = $this->uri->segment(3);
		$get_db = $this->m_files->get_file_byid($id);
		$q = $get_db->row_array();
		$file = $q['file_data'];
		var_dump($file);
		$path = './asset/files/ktp/' . $file;
		$data = file_get_contents($path);
		$name = $file;
		force_download($name, $data);
	}

	function getUserlist()
	{
		$data['judul'] = 'User Lists';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['profil'] = $this->db->get_where('admin', ['username' => $data['user']['id']])->row_array();

		$this->load->model('user_model', 'userM');
		$data['level'] = $this->db->get('user_level')->result_array();
		//$data['user'] = $this->db->from('user');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('username', $data['keyword']);
		$this->db->from('user');
		$this->db->where('level_id != 1 AND level_id != 2');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/admin/getUserlist';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['users'] = $this->userM->getUsers($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id']);

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');
	}

	public function deleteU($id)
	{
		$this->db->delete('user', array('id' => $id));
		$this->session->set_flashdata('pesan', '1 User berhasil dihapus');
		redirect('admin/index');

		//sintak : bgst
		//$this->session->set_flashdata('pesan', 'Hapus User gagal');
	}

	public function updateU($id)
	{
		var_dump($this->input->post('level'));
		$data = array(
			'username' => $this->input->post('username'),
			'level_id' => $this->input->post('level'),
		);

		$this->db->where('id', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('pesan', 'Edit Data User berhasil');
		redirect('admin/index');
	}
}
