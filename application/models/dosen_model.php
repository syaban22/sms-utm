<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dosen_model extends CI_Model
{
    public function getDosen($limit, $start, $keyword = null)
    {
        if ($keyword !== null) {
            $query =
                "
			SELECT d.nip, d.nama, u.username, p.prodi FROM dosen d, prodi p, user u WHERE d.prodi = p.kode_prodi and d.username = u.id and (d.nama LIKE '%$keyword%'OR p.prodi LIKE '%$keyword%' OR d.nip LIKE '%$keyword%') limit $start, $limit
		";
        } else {
            $query =
                "
			SELECT d.nip, d.nama, u.username, p.prodi FROM dosen d, prodi p, user u WHERE d.prodi = p.kode_prodi and d.username = u.id limit $start, $limit
		";
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }

    // public function getUserDosen()
    // {
    //     $query =
    //         "
    //         SELECT u.username FROM dosen d, user u WHERE d.username = u.id";

    //     return $this->db->query($query)->result_array();
    // }
}
