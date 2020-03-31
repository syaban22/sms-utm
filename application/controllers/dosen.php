<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil']= $this->db->get_where('dosen', ['username' => $userid['id']])->row_array();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar_user', $data);
        $this->load->view('dosen/index', $data);
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
            redirect('dosen');
        } else {
            $old_img = $data['user']['gambar'];
            if ($old_img != 'default.jpg') {
                unlink(FCPATH . '/assets/img/profile/' . $old_img);
            }
            
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('pesan', 'Update Foto Berhasil');
            redirect('dosen');
        }
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
            $this->load->view('dosen/index', $data);
            $this->load->view('template/footer');
        } else {
            $curpass = $this->input->post('curpass');
            $newpass = $this->input->post('newpass');
            if (!password_verify($curpass, $data['user']['password'])) {
                $this->session->set_flashdata('ms', '<div class="alert-danger" role="alert">Password Lama Salah!</div>');
                $this->session->set_flashdata('pesan', 'Gagal pass');
                redirect('dosen');
            } else {
                if ($curpass == $newpass) {
                    $this->session->set_flashdata('msg', '<div class="alert-danger" role="alert">Password Baru tidak boleh sama dengan Password Lama!</div>');
                    $this->session->set_flashdata('pesan', 'Gagal pass');
                    redirect('dosen');
                } else {
                    $pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', 'Ubah Password Berhasil');
                    redirect('dosen');
                }
            }
        }
    }

    public function getMahasiswa()
    {
        $this->session->unset_userdata('keyword');
        $data['judul'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil']= $this->db->get_where('dosen', ['username' => $userid['id']])->row_array();
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
        $this->load->view('dosen/mahasiswa', $data);
        $this->load->view('template/footer');
    }


    // public function perusahaan()
    // {
    //     $data['judul'] = 'Perusahaan';
    //     $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    //     $data['perusahaan'] = $this->db->get('perusahaan')->result_array();

    //     $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('template/header', $data);
    //         $this->load->view('template/sidebar', $data);
    //         $this->load->view('template/topbar', $data);
    //         $this->load->view('dosen/perusahaan', $data);
    //         $this->load->view('template/footer');
    //     } else {
    //         $data = [
    //             'perusahaan' => $this->input->post('perusahaan'),
    //         ];

    //         $this->db->insert('perusahaan', $data);
    //         $this->session->set_flashdata('pesan', 'Perusahaan baru berhasil ditambahkan');
    //         redirect('dosen/perusahaan');
    //     }
    // }


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
}
