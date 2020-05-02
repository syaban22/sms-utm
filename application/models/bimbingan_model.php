<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bimbingan_model extends CI_Model
{
    public function getCatatan($nim)
    {
        $query =  $this->db->query("SELECT s.judul, b.pembahasan, b.tanggal, b.tempat, d.nama  
        FROM bimbingan b, dosen d, skripsi s, mahasiswa m
        WHERE b.id_skripsi=s.id AND b.dosbing=d.nip AND m.nim = s.nim AND s.nim=$nim");
        return $query->result_array();
    }
}
