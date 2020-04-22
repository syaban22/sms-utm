<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jenkel_model extends CI_Model
{
    public function getJenkel()
    {
        return $this->db->get('jenkel')->result_array();
    }
}
