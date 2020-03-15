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

	function daftarDosen()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Dosen';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


		$this->load->model('dosen_model', 'dosenM');
		$data['prodi'] = $this->db->get('prodi')->result_array();
		$data['username'] = $this->db->get_where('user', ['level_id' => '3'])->result_array();
		//$data['user'] = $this->db->from('user');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nama', $data['keyword']);
		$this->db->from('dosen');
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
		// $data['userDosen'] = $this->dosenM->getUserDosen();

		$this->form_validation->set_rules('nip', 'nipdosen', 'required');
		$this->form_validation->set_rules('nama', 'namadosen', 'required');
		$this->form_validation->set_rules('prodi', 'prodidosen', 'required');

		if ($this->input->post('username') == NULL) {
			$username = 'NULL';
		} else {
			$username = $this->input->post('username');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/daftarDosen', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'username' => $username,
				'prodi' => $this->input->post('prodi'),
			];

			$this->db->insert('dosen', $data);
			$this->session->set_flashdata('pesan', 'ditambahkan');
			redirect('admin/daftarDosen');
		}
	}

	public function updateDosen($id)
	{
		$this->form_validation->set_rules('nip', 'nip', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('prodi', 'prodi', 'required');

		$data = array(
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'prodi' => $this->input->post('prodi'),
		);

		$this->db->where('nip', $id);
		$this->db->update('dosen', $data);
		$this->session->set_flashdata('pesan', 'Edit data Program Studi berhasil');
		redirect('admin/daftarDosen');
	}

	public function deleteDosen($id)
	{
		$this->db->delete('dosen', array('nip' => $id));
		$this->session->set_flashdata('pesan', 'Program Studi berhasil dihapus');
		redirect('admin/daftarDosen');
	}

	function daftarMahasiswa()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Mahasiswa';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


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
		$this->form_validation->set_rules('prodi', 'prodimahasiswa', 'required');

		if ($this->input->post('username') == NULL) {
			$username = 'NULL';
		} else {
			$username = $this->input->post('username');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/daftarMahasiswa', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'nim' => $this->input->post('nim'),
				'nama' => $this->input->post('nama'),
				'username' => $username,
				'prodi' => $this->input->post('prodi'),
			];

			$this->db->insert('mahasiswa', $data);
			$this->session->set_flashdata('pesan', 'ditambahkan');
			redirect('admin/daftarMahasiswa');
		}
	}

	public function updateMahasiswa($id)
	{
		$this->form_validation->set_rules('nim', 'nim', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('prodi', 'prodi', 'required');

		$data = array(
			'nim' => $this->input->post('nim'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'prodi' => $this->input->post('prodi'),
		);

		$this->db->where('nim', $id);
		$this->db->update('mahasiswa', $data);
		$this->session->set_flashdata('pesan', 'Edit data Program Studi berhasil');
		redirect('admin/daftarMahasiswa');
	}

	public function deleteMahasiswa($id)
	{
		$this->db->delete('mahasiswa', array('nim' => $id));
		$this->session->set_flashdata('pesan', 'Program Studi berhasil dihapus');
		redirect('admin/daftarMahasiswa');
	}

	public function daftarSkripsi()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Daftar Skripsi';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

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
		$data = array(
			'dosen_uji3' => $this->input->post('penguji3'),
		);

		$this->db->where('id', $id);
		$this->db->update('skripsi', $data);
		$this->session->set_flashdata('pesan', 'diubah');
		redirect('admin/daftarSkripsi');
	}

	public function deletePelamar($id)
	{
		$this->db->delete('lamar_pekerjaan', array('id' => $id));
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('admin');
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

	public function rubahakses()
	{
		$menu_id = $this->input->post('menuId');
		$level_id = $this->input->post('levelId');

		$data = [
			'role_id' => $level_id,
			'menu_id' => $menu_id
		];

		$hasil = $this->db->get_where('user_access_menu', $data);

		if ($hasil->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('pesan', 'Akses telah diganti');
	}

	public function perusahaan()
	{
		$data['judul'] = 'Perusahaan';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$data['perusahaan'] = $this->db->get('perusahaan')->result_array();

		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('admin/perusahaan', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'perusahaan' => $this->input->post('perusahaan'),
			];

			$this->db->insert('perusahaan', $data);
			$this->session->set_flashdata('pesan', 'Perusahaan baru berhasil ditambahkan');
			redirect('admin/perusahaan');
		}
	}

	public function updateP($id)
	{
		$data = array(
			'perusahaan' => $this->input->post('perusahaanU'),
		);

		$this->db->where('id', $id);
		$this->db->update('perusahaan', $data);
		$this->session->set_flashdata('pesan', 'Edit data Perusahaan berhasil');
		redirect('admin/perusahaan');
	}

	public function deleteP($id)
	{
		$this->db->delete('perusahaan', array('id' => $id));
		$this->session->set_flashdata('pesan', 'Perusahaan berhasil dihapus');
		redirect('admin/perusahaan');
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
		$data['judul'] = 'Manajemen User';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

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
		$this->session->set_flashdata('pesan', 'User berhasil dihapus');
		redirect('admin/index');
	}

	public function updateU($id)
	{
		var_dump($this->input->post('level'));
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'level_id' => $this->input->post('level'),
		);

		$this->db->where('id', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('pesan', 'Edit Data User berhasil');
		redirect('admin/index');
	}
}
