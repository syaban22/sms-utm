<?php
defined('BASEPATH') or exit('No direct script access allowed');

class fakultas_model extends CI_Model
{
    public function getFakultas($limit, $start, $keyword = null)
    {
        if ($keyword !== null) {
            $query =
                "
			SELECT f.kode_fak, f.fakultas FROM fakultas f WHERE f.fakultas LIKE '%$keyword%' limit $start, $limit
		";
        } else {
            $query =
                "
			SELECT f.kode_fak, f.fakultas FROM fakultas f WHERE f.kode_fak limit $start, $limit
		";
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }

    // function fetch_fakultas()
    // {
    //     $query = $this->db->get('fakultas');
    //     return $query->result();
    // }
}
