<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mahasiswa_model extends CI_Model
{
    public function getMahasiswa($limit, $start, $keyword = null)
    {
        if ($keyword !== null) {
            $query =
                "
			SELECT m.nim, m.nama, u.username, p.prodi FROM mahasiswa m, prodi p, user u WHERE m.prodi = p.kode_prodi and m.username = u.id and (m.nama LIKE '%$keyword%' OR p.prodi LIKE '%$keyword%' OR u.username LIKE '%$keyword%') limit $start, $limit
        ";
        } else {
            $query =
                "
			SELECT m.nim, m.nama, u.username, p.prodi FROM mahasiswa m, prodi p, user u WHERE m.prodi = p.kode_prodi and m.username = u.id limit $start, $limit
		";
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }
}
