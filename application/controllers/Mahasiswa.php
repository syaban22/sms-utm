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
        $this->load->model('skripsi_model');
    }

    public function index()
    {
        redirect('Mahasiswa/Profile');
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
        // $config['max_width']            = 500;
        // $config['max_height']           = 500;
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
            $old_img = $data['profil']['gambar'];
            if ($old_img != 'default.jpg') {
                unlink(FCPATH . '/assets/img/profile/' . $old_img);
            }

            $this->db->where('username', $id);
            $this->db->update('mahasiswa', $data);
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

        $config['upload_path']          = './assets/files/berkas';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 2000;
        $config['encrypt_name']            = TRUE;

        $this->upload->initialize($config);


        if ($this->db->get_where('skripsi', ['nim' => $nim])->row_array() == true) {
            //nanti diubah ketika masih ada skripsi yang belum lulus baru dialihkan #pake looping
            $this->session->set_flashdata('pesan', 'Anda telah mendaftarkan 1 Skripsi');
            redirect('Mahasiswa/StatusSkripsi');
        }
        if ($this->form_validation->run() == false) {
            if (!$this->upload->do_upload('file')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data['error'] = "Complete validation above and upload it again";
            }
            $this->load->view('template/header_Pekerjaan', $data);
            // $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('Mahasiswa/DaftarkanSkripsi');
            $this->load->view('template/footer');
        } else {
            if (!$this->upload->do_upload('file')) {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('template/header_Pekerjaan', $data);
                // $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar');
                $this->load->view('Mahasiswa/DaftarkanSkripsi');
                $this->load->view('template/footer');
            } else {
                $this->upload->do_upload('file');
                $gbr = $this->upload->data();
                $file = $gbr['file_name'];
                var_dump($file);
                $data = [
                    'judul' => $this->input->post('judul'),
                    'abstract' => $this->input->post('abstract'),
                    'prodi' => substr($nim, 3, 4),
                    'nim' => $nim,
                    'dosbing_1' => $this->input->post('dosbing1'),
                    'dosbing_2' => $this->input->post('dosbing2'),
                    'status' => '1',
                    'berkas' => $file
                ];
                $this->db->insert('skripsi', $data);
                $this->session->set_flashdata('pesan', 'Skripsi Anda berhasil didaftarkan');
                redirect('Mahasiswa/Profile');
            }
            //echo $this->input->post('dosbing1');
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

        // paging ini bisa dihapus kalau memang tidak dibutuhkan!!!!!!!!!!!!!!!!!!!!!!!!!!
        // if ($this->input->post('submit')) {
        //     $data['keyword'] = $this->input->post('keyword');
        //     $this->session->set_userdata('keyword', $data['keyword']);
        // } else {
        //     $data['keyword'] = $this->session->userdata('keyword');
        // }

        // $this->db->like('nim', $data['keyword']);
        // $this->db->from('skripsi');
        // // $this->db->where('level_id != 1 AND level_id != 2');
        // $config['total_rows'] = $this->db->count_all_results();
        // $data['total_rows'] = $config['total_rows'];
        // $config['base_url'] = 'http://localhost/sms-utm/admin/StatusSkripsi';

        // $config['per_page'] = 5;

        // $this->pagination->initialize($config);

        // if ($this->uri->segment(3) !== null) {
        //     $data['start'] = $this->uri->segment(3);
        // } else {
        //     $data['start'] = 0;
        // }
        // $data['skripsi'] = $this->skripsiM->getSkripsi($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id']);
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // $data['skripsi'] = $this->db->get('skripsi')->result_array();
        $data['skripsi'] = $this->db->get_where('skripsi', ['nim' => $this->session->userdata('username')])->result_array();
        $data['penguji'] = $this->skripsiM->getPenguji();

        $data['bimbingan'] = $this->db->get('dosen')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('mahasiswa/StatusSkripsi');
        $this->load->view('template/footer');
    }

    public function getDataSkripsi()
    {
        $nim_mhs = $_POST['nim_mhs'];
        $data['detail']  = $this->skripsi_model->get_detail($nim_mhs);
        $this->load->view("mahasiswa/modal", $data);
    }


    public function changePassword()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('curpass', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('newpass', 'Password Baru', 'required|trim|min_length[8]|matches[conpass]');
        $this->form_validation->set_rules('conpass', 'Konfirmasi Password', 'required|trim|min_length[8]|matches[newpass]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('mt', '<div class="alert alert-danger" role="alert">Update Password Gagal, harap periksa kembali.</div>');
            redirect('Mahasiswa/Profile');
        } else {
            $curpass = $this->input->post('curpass');
            $newpass = $this->input->post('newpass');
            if (!password_verify($curpass, $data['user']['password'])) {
                $this->session->set_flashdata('ms', '<div class="alert-danger" role="alert">Password Lama Salah!</div>');
                $this->session->set_flashdata('pesan', 'Gagal pass');
                redirect('Mahasiswa/Profile');
            } else {
                if ($curpass == $newpass) {
                    // echo "test";
                    $this->session->set_flashdata('msg', '<div class="alert-danger" role="alert">Password Baru tidak boleh sama dengan Password Lama!</div>');
                    $this->session->set_flashdata('pesan', 'Gagal pass');
                    redirect('Mahasiswa/Profile');
                } else {
                    $pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('pesan', 'Ubah Password Berhasil');
                    redirect('Mahasiswa/Profile');
                }
            }
        }
    }

    public function JadwalSempro()
    {
        $this->session->unset_userdata('keyword');
        $data['judul'] = 'Jadwal Sempro';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();
        $this->load->model('jadwal_model', 'jadwalM');
        $this->load->model('skripsi_model', 'skripsiM');
        $data['level'] = $this->db->get('user_level')->result_array();
        //$data['user'] = $this->db->from('user');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('s.judul', $data['keyword']);
        $this->db->from('jadwal_sempro js, skripsi s');
        $this->db->where('s.id = js.id_skripsi');
        // $this->db->where('level_id != 1 AND level_id != 2');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['base_url'] = 'http://localhost/sms-utm/mahasiswa/JadwalSempro';

        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        if ($this->uri->segment(3) !== null) {
            $data['start'] = $this->uri->segment(3);
        } else {
            $data['start'] = 0;
        }

        // $data['skri'] = $this->db->get_where('skripsi', ['nim' => $this->session->userdata('username')])->row_array();
        // var_dump($data['skri']);

        $data['JSemp'] = $this->jadwalM->getJadwalSempro($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id'], $data['user']['username'], null);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('mahasiswa/JadwalSempro', $data);
        $this->load->view('template/footer');
    }

    public function JadwalSidang()
    {
        $this->session->unset_userdata('keyword');
        $data['judul'] = 'Jadwal Sidang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();
        $this->load->model('jadwal_model', 'jadwalM');
        $this->load->model('skripsi_model', 'skripsiM');
        $data['level'] = $this->db->get('user_level')->result_array();
        //$data['user'] = $this->db->from('user');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('s.judul', $data['keyword']);
        $this->db->from('jadwal_sidang js, skripsi s');
        $this->db->where('s.id = js.id_skripsi');
        // $this->db->where('level_id != 1 AND level_id != 2');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['base_url'] = 'http://localhost/sms-utm/mahasiswa/JadwalSidang';

        $config['per_page'] = 5;

        $this->pagination->initialize($config);

        if ($this->uri->segment(3) !== null) {
            $data['start'] = $this->uri->segment(3);
        } else {
            $data['start'] = 0;
        }

        // $data['skri'] = $this->db->get_where('skripsi', ['nim' => $this->session->userdata('username')])->row_array();
        // var_dump($data['skri']);

        $data['JSid'] = $this->jadwalM->getJadwalSidang($config['per_page'], $data['start'], $data['keyword'], $data['user']['level_id'], $data['user']['username'], null);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('mahasiswa/JadwalSidang', $data);
        $this->load->view('template/footer');
    }

    public function DaftarSempro($id)
    {
        $data = [
            'id_skripsi' => $id,
            'tanggal' => 'pending',
            'waktu' => 'pending',
            'periode' => 'pending',
            'penguji_1' => NULL,
            'penguji_2' => NULL,
            'penguji_3' => NULL,
            'ruangan' => 'pending',
        ];
        $id_skripsi = $this->db->get_where('skripsi', ['id' => $id])->row_array()['id'];
        $this->db->insert('jadwal_sempro', $data);
        echo $id_skripsi;
        $data = [
            'status' => '2'
        ];
        $this->db->where('id', $id_skripsi);
        $this->db->update('skripsi', $data);
        $this->session->set_flashdata('pesan', 'Mendaftarkan Skripsi untuk Sempro berhasil');
        redirect('mahasiswa/StatusSkripsi');
    }

    //method untuk catatan bimbingan
    public function MhsBimbingan()
    {
        $this->session->set_flashdata('pesan', 'Mengajukan Bimbingan Skripsi Berhasil');
        redirect('mahasiswa/StatusSkripsi');
    }

    //method untuk catatan bimbingan
    public function CatBim()
    {
        $this->session->unset_userdata('keyword');
        $data['judul'] = 'Catatan Bimbingan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $userid = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['profil'] = $this->db->get_where('mahasiswa', ['username' => $userid['id']])->row_array();
        $this->load->model('bimbingan_model', 'bimbinganM');

        $data['start'] = 0;
        $data['bimbingan'] = $this->bimbinganM->getCatatan($data['user']['username'], $data['user']['level_id']);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('mahasiswa/CatatanBimbingan', $data);
        $this->load->view('template/footer');
    }
}
