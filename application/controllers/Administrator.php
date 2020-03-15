<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$this->session->unset_userdata('keyword');
		$data['judul'] = 'Dashboard';
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
		$config['base_url'] = 'http://localhost/sms-utm/administrator/getUserlist';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['users'] = $this->userM->getUsers($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id']);



		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('level', 'level', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('administrator/index', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama')),
				'email' => htmlspecialchars("NULL"),
				'gambar' => "default.jpg",
				'username' => htmlspecialchars($this->input->post('username')),
				'password' => password_hash($this->input->post('username'), PASSWORD_DEFAULT),
				'level_id' => $this->input->post('level'),
				'tgl_buat' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('pesan', 'ditambahkan');
			redirect('administrator/index');
		}
	}

	public function deleteU($id)
	{
		$this->db->delete('user', array('id' => $id));
		$this->session->set_flashdata('pesan', 'User berhasil dihapus');
		redirect('administrator/index');
	}

	public function updateU($id)
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'level_id' => $this->input->post('level'),
		);

		$this->db->where('id', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('pesan', 'Edit Data User berhasil');
		redirect('administrator/index');
	}

	public function Fakultas()
	{
		$this->session->unset_userdata('keyword');

		$data['judul'] = 'Daftar Fakultas';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		// $data['fakultas'] = $this->db->get('fakultas')->result_array();

		$this->load->model('fakultas_model', 'fakultasM');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('fakultas', $data['keyword']);
		$this->db->from('fakultas');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/administrator/fakultas';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['fakultas'] = $this->fakultasM->getFakultas($config['per_page'], $data['start'], $data['keyword']);


		$this->form_validation->set_rules('fakultas', 'Fakultas', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('administrator/fakultas', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'kode_fak' => $this->input->post('kodefak'),
				'fakultas' => $this->input->post('fakultas'),
			];

			$this->db->insert('fakultas', $data);
			$this->session->set_flashdata('pesan', 'ditambahkan');
			redirect('administrator/fakultas');
		}
	}

	public function updateFakultas($id)
	{
		$data = array(
			'fakultas' => $this->input->post('fakultasU'),
		);

		$this->db->where('kode_fak', $id);
		$this->db->update('fakultas', $data);
		$this->session->set_flashdata('pesan', 'diubah');
		redirect('administrator/fakultas');
	}

	public function deleteFakultas($id)
	{
		$this->db->delete('fakultas', array('kode_fak' => $id));
		$this->session->set_flashdata('pesan', 'dihapus');
		redirect('administrator/fakultas');
	}

	public function ProgramStudi()
	{
		$this->session->unset_userdata('keyword');

		$data['judul'] = 'Daftar Program Studi';
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		// $data['prodi'] = $this->db->get('prodi')->result_array();
		$data['fakultas'] = $this->db->get('fakultas')->result_array();

		$this->load->model('prodi_model', 'prodiM');

		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('prodi', $data['keyword']);
		$this->db->from('prodi');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['base_url'] = 'http://localhost/sms-utm/administrator/ProgramStudi';

		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		if ($this->uri->segment(3) !== null) {
			$data['start'] = $this->uri->segment(3);
		} else {
			$data['start'] = 0;
		}

		$data['prodi'] = $this->prodiM->getProdi($config['per_page'], $data['start'], $data['keyword']);

		$this->form_validation->set_rules('kodefak', 'fakultas', 'required');
		$this->form_validation->set_rules('kodeprodi', 'prodi', 'required');
		$this->form_validation->set_rules('prodi', 'prodi', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('administrator/ProgramStudi', $data);
			$this->load->view('template/footer');
		} else {
			$data = [
				'kode_fak' => $this->input->post('kodefak'),
				'kode_prodi' => $this->input->post('kodeprodi'),
				'prodi' => $this->input->post('prodi'),
			];

			$this->db->insert('prodi', $data);
			$this->session->set_flashdata('pesan', 'Program Studi baru berhasil ditambahkan');
			redirect('administrator/ProgramStudi');
		}
	}

	public function updateProdi($id)
	{
		$data = array(
			'prodi' => $this->input->post('prodiU'),
		);

		$this->db->where('kode_prodi', $id);
		$this->db->update('prodi', $data);
		$this->session->set_flashdata('pesan', 'Edit data Program Studi berhasil');
		redirect('administrator/ProgramStudi');
	}

	public function deleteProdi($id)
	{
		$this->db->delete('prodi', array('kode_prodi' => $id));
		$this->session->set_flashdata('pesan', 'Program Studi berhasil dihapus');
		redirect('administrator/ProgramStudi');
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
			$this->load->view('administrator/level', $data);
			$this->load->view('template/footer');
		} else {
			$this->db->insert('user_level', ['level' => $this->input->post('level')]);
			$this->session->set_flashdata('pesan', 'Level baru berhasil ditambahkan');
			redirect('administrator/level');
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
		redirect('administrator/level');
	}

	public function delete($id)
	{
		$this->db->delete('user_level', array('id' => $id));
		$this->session->set_flashdata('pesan', 'Level berhasil dihapus');
		redirect('administrator/level');
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
		$this->load->view('administrator/level-akses', $data);
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
		$config['base_url'] = 'http://localhost/sms-utm/administrator/daftarDosen';

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
			$this->load->view('administrator/daftarDosen', $data);
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
			redirect('administrator/daftarDosen');
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
		redirect('administrator/daftarDosen');
	}

	public function deleteDosen($id)
	{
		$this->db->delete('dosen', array('nip' => $id));
		$this->session->set_flashdata('pesan', 'Program Studi berhasil dihapus');
		redirect('administrator/daftarDosen');
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
		$config['base_url'] = 'http://localhost/sms-utm/administrator/daftarMahasiswa';

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
			$this->load->view('administrator/daftarMahasiswa', $data);
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
			redirect('administrator/daftarMahasiswa');
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
		redirect('administrator/daftarMahasiswa');
	}

	public function deleteMahasiswa($id)
	{
		$this->db->delete('mahasiswa', array('nim' => $id));
		$this->session->set_flashdata('pesan', 'Program Studi berhasil dihapus');
		redirect('administrator/daftarMahasiswa');
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
		$this->session->unset_userdata('keyword');

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
		$config['base_url'] = 'http://localhost/sms-utm/administrator/getUserlist';

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
		$this->load->view('administrator/index', $data);
		$this->load->view('template/footer');
	}
}