<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->library('upload');
        $this->load->model('fakultas_model');
    }

    public function index()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();
        // $em = $this->session->userdata('email');
        // $this->db->select_sum('cek');
        // $this->db->from('lamar_pekerjaan');
        // $this->db->where('email', $em);
        // $query = $this->db->get();
        // $data['stat'] = $query->row()->cek;

        // $this->session->set_userdata('stat', $data['stat']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar_user', $data);
        $this->load->view('Mahasiswa/index', $data);
        $this->load->view('template/footer');
    }

    public function Profile()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();
        // var_dump($data['profil']);
        // die;
        // $em = $this->session->userdata('email');
        // $em = $this->session->userdata('email');
        // $this->db->select_sum('cek');
        // $this->db->from('lamar_pekerjaan');
        // $this->db->where('email', $em);
        // $query = $this->db->get();
        // $data['stat'] = $query->row()->cek;

        // $this->session->set_userdata('stat', $data['stat']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar_user', $data);
        $this->load->view('Mahasiswa/index', $data);
        $this->load->view('template/footer');
    }

    public function UbahFoto($id)
    {
        $config['upload_path']          = './assets/img/profile/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 2000;
        $config['max_width']            = 500;
        $config['max_height']           = 500;
        $config['overwrite']             = TRUE;

        $this->upload->initialize($config);

        $this->upload->do_upload('UbahFoto');
        $gbr = $this->upload->data();
        $file = $gbr['file_name'];

        $data = [
            'gambar' => $file,
        ];
        if ($this->upload->do_upload('UbahFoto') == false) {
            $this->session->set_flashdata('pesan', 'Format Foto Salah');
            redirect('Mahasiswa/Profile');
        } else {
            $old_img = $data['user']['gambar'];
            if ($old_img != 'default.jpg') {
                unlink(FCPATH . '/assets/img/profile/' . $old_img);
            }

            $this->db->where('id', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('pesan', 'Update Foto Berhasil');
            redirect('Mahasiswa/Profile');
        }
    }

    public function DaftarkanSkripsi()
    {
        //nim mahasiswa
        $nim = $this->session->userdata('username');
        //nim untuk kode fakultas dan prodi
        $data['fakultas'] = substr($nim, 2, 2);
        $data['prodi'] = substr($nim, 3, 4);
        //data untuk tampilan
        $data['judul'] = "Daftarkan Judul";

        //$data['judul'] = 'Daftarkan Skripsi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();

        //$data['fakultas'] = $this->db->get('fakultas')->result_array();
        //$data['prodi'] = $this->db->get('prodi')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('abstract', 'Abstract', 'required');
        $this->form_validation->set_rules('dosbing1', 'Dosbing1', 'required');
        $this->form_validation->set_rules('dosbing2', 'Dosbing2', 'required');


        if ($this->db->get('skripsi')->result_array() == true) {
            $this->session->set_flashdata('pesan', 'Anda telah mendaftarkan 1 Skripsi');
            redirect('Mahasiswa/StatusSkripsi');
        } else {

            if ($this->form_validation->run() == false) {
                $this->load->view('template/header_Pekerjaan', $data);
                // $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar', $data);
                $this->load->view('Mahasiswa/DaftarkanSkripsi', $data);
                $this->load->view('template/footer');
            } else {
                $data = [
                    'judul' => $this->input->post('judul'),
                    'abstract' => $this->input->post('abstract'),
                    'prodi' => substr($nim, 3, 4),
                    'nim' => $nim,
                    'dosbing_1' => $this->input->post('dosbing1'),
                    'dosbing_2' => $this->input->post('dosbing2')
                ];
                var_dump($data);
                //echo $this->input->post('dosbing1');
                $this->db->insert('skripsi', $data);
                $this->session->set_flashdata('pesan', 'berhasil dikirim');
                redirect('Mahasiswa/index');
            }
        }

        // $config['upload_path']          = './asset/files/ktp/';
        // $config['allowed_types']        = 'doc|docx|pdf';
        // $config['max_size']             = 2000;
        // $config['encrypt_name']            = TRUE;

        // $this->upload->initialize($config);

        // if ($this->form_validation->run() == false) {
        //     if (!$this->upload->do_upload('ktp')) {
        //         $data['error'] = $this->upload->display_errors();
        //     } else {
        //         $data['error'] = "Complete validation above and upload it again";
        //     }
        //     $data['posisi_id'] = $this->input->post('posisi');
        //     $this->load->view('template/header_Pekerjaan', $data);
        //     // $this->load->view('template/sidebar', $data);
        //     $this->load->view('template/topbar_user', $data);
        //     $this->load->view('Mahasiswa/DaftarkanSkripsi', $data);
        //     $this->load->view('template/footer');
        // } else {
        //     if (!$this->upload->do_upload('ktp')) {
        //         $data['error'] = $this->upload->display_errors();
        //         $this->load->view('template/header_Pekerjaan', $data);
        //         // $this->load->view('template/sidebar', $data);
        //         $this->load->view('template/topbar', $data);
        //         $this->load->view('Mahasiswa/DaftarkanSkripsi', $data);
        //         $this->load->view('template/footer');
        //     } else {
        //         $this->upload->do_upload('ktp');
        //         $gbr = $this->upload->data();
        //         $file = $gbr['file_name'];
        //         $data = [
        //             'judul' => $this->input->post('judul'),
        //             'nim' => $this->input->post('nim'),
        //             'dosbing_1' => $this->input->post('dosbing1'),
        //             'dosbing_2' => $this->input->post('dosbing2'),
        //             'prodi' => $this->input->post('prodi'),
        //         ];

        //         $this->db->insert('skripsi', $data);
        //         $this->session->set_flashdata('pesan', 'berhasil dikirim');
        //         redirect('Mahasiswa/index');
        //     }
        // }
    }

    public function StatusSkripsi()
    {
        $this->session->unset_userdata('keyword');
        $data['judul'] = 'Status Skripsi';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();

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
        $config['base_url'] = 'http://localhost/sms-utm/admin/StatusSkripsi';

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
        $this->load->view('mahasiswa/StatusSkripsi', $data);
        $this->load->view('template/footer');
    }

    public function getStatus()
    {
        $data['judul'] = 'Status';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $usr = $this->session->userdata('email');

        $this->load->model('user_model', 'UsM');

        //$data['perusahaan'] = $this->pelamarM->getPerusahaan();
        $data['posisi'] = $this->db->get('posisi')->result_array();
        $data['perusahaan'] = $this->db->get('perusahaan')->result_array();

        $cek = array(
            'cek' => $this->input->get('st'),
        );

        // $this->db->where('id', $id);
        $this->db->update('lamar_pekerjaan', $cek);


        //filter
        $nomor = $this->input->post('data');
        //echo $perusahaan;
        //$per = $this->db->get_where('lamar_pekerjaan', ['perusahaan_id' => $perusahaan])->result();

        //print_r($per);

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        if ($data['keyword'] == NULL) {
            $this->db->like('email', $usr);
            $this->db->from('lamar_pekerjaan l, perusahaan p');
            $this->db->where('l.perusahaan_id = p.id');
        } else {
            $this->db->like('perusahaan', $data['keyword']);
            $this->db->from('lamar_pekerjaan, perusahaan');
            $this->db->where('lamar_pekerjaan.perusahaan_id = perusahaan.id');
            $this->db->where('lamar_pekerjaan.email', $usr);
        }
        $config['total_rows'] = $this->db->count_all_results();
        $config['base_url'] = 'http://localhost/uas/user/getStat';

        $data['total_rows'] = $config['total_rows'];
        // if ($perusahaan == 0) {
        // 	$perusahaan = 5;
        // }
        $config['per_page'] = 5;
        //$data['start'] = $this->uri->segment(3);
        //var_dump($this->input->post('num_rows'));


        // $data['jumlah_page'] = ceil($config['total_rows'] / $config['per_page']);
        // $data['page'] = ceil(($this->uri->segment(3) / $data['jumlah_page']));
        // if ($data['page'] == 0) {
        // 	$data['page'] = 1;
        // }

        $this->pagination->initialize($config);


        if ($this->uri->segment(3) !== null) {
            $data['start'] = $this->uri->segment(3);
        } else {
            $data['start'] = 0;
        }

        $data['pelamar'] = $this->UsM->getStat($config['per_page'], $data['start'], $data['keyword'], $usr);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/getStatus', $data);
        $this->load->view('template/footer');
    }

    public function changePassword()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $em = $this->session->userdata('email');

        // $this->db->select_sum('cek');
        // $this->db->from('lamar_pekerjaan');
        // $this->db->where('email', $em);
        // $query = $this->db->get();
        // $data['stat'] = $query->row()->cek;

        $this->form_validation->set_rules('curpass', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('newpass', 'Password Baru', 'required|trim|min_length[8]|matches[conpass]');
        $this->form_validation->set_rules('conpass', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[newpass]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('mt', '<div class="alert alert-danger" role="alert">Update Password Gagal, harap periksa kembali.</div>');
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar_user', $data);
            $this->load->view('Mahasiswa/index', $data);
            $this->load->view('template/footer');
        } else {
            $curpass = $this->input->post('curpass');
            $newpass = $this->input->post('newpass');
            if (!password_verify($curpass, $data['user']['password'])) {
                $this->session->set_flashdata('ms', '<div class="alert-danger" role="alert">Password Lama Salah!</div>');
                $this->session->set_flashdata('pesan', 'Gagal pass');
                redirect('Mahasiswa/Profile');
            } else {
                if ($curpass == $newpass) {
                    $this->session->set_flashdata('msg', '<div class="alert-danger" role="alert">Password Baru tidak boleh sama dengan Password Lama!</div>');
                    $this->session->set_flashdata('pesan', 'Gagal pass');
                    redirect('Mahasiswa/Profile');
                } else {
                    $pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', 'Ubah Password Berhasil');
                    redirect('Mahasiswa/Profile');
                }
            }
        }
    }
}
