<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bimbingan_model extends CI_Model
{
    public function getCatatan($nim, $level)
    {
        if ($level == 3) {
            $query =  $this->db->query("SELECT b.id, s.judul, b.pembahasan, b.tanggal, b.tempat, d.nama  
        FROM bimbingan b, dosen d, skripsi s, mahasiswa m
        WHERE b.id_skripsi=s.id AND b.dosbing=d.nip AND m.nim = s.nim AND d.nip=$nim
        ORDER BY b.pembahasan ASC");
        }
        if ($level == 4) {
            $query =  $this->db->query("SELECT s.judul, b.pembahasan, b.tanggal, b.tempat, d.nama  
        FROM bimbingan b, dosen d, skripsi s, mahasiswa m
        WHERE b.id_skripsi=s.id AND b.dosbing=d.nip AND m.nim = s.nim AND s.nim=$nim");
        }
        return $query->result_array();
    }
    public function cekcatatan($nim){
        $query =  $this->db->query("SELECT s.judul, b.pembahasan, b.tanggal, b.tempat, d.nama  
        FROM bimbingan b, dosen d, skripsi s, mahasiswa m
        WHERE b.id_skripsi=s.id AND b.dosbing=d.nip AND m.nim = s.nim AND s.nim=$nim");
        return $query->result_array();
    }
}
