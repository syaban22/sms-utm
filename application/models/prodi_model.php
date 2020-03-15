<?php
defined('BASEPATH') or exit('No direct script access allowed');

class prodi_model extends CI_Model
{
    public function getProdi($limit, $start, $keyword = null)
    {
        if ($keyword !== null) {
            $query =
                "
			SELECT * FROM prodi p WHERE p.prodi LIKE '%$keyword%' limit $start, $limit
		";
        } else {
            $query =
                "
                SELECT * FROM prodi p WHERE p.kode_prodi limit $start, $limit
		";
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }

    // function fetch_prodi($kode_fak)
    // {
    //     $this->db->where('kode_fak', $kode_fak);
    //     $query = $this->db->get('prodi');
    //     $output = '<option value="">Pilih Prodi</option>';
    //     foreach ($query->result() as $row) {
    //         $output .= '<option value="' . $row->kode_prodi . '">' . $row->prodi . '</option>';
    //     }
    //     return $output;
    // }
}
