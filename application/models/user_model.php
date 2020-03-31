<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
    public function getUsers($limit, $start, $keyword = null, $user)
    {
        //administrator
        if ($user == 1) {
            if ($keyword !== null) {
                $query =
                    "
			SELECT u.id,  u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id = l.id and (u.username LIKE '%$keyword%' OR l.level LIKE '%$keyword%') limit $start, $limit
		";
            } else {
                $query =
                    "
			SELECT u.id,  u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id = l.id limit $start, $limit
		";
            }
        }
        //admin prodi
        if (($user == 2)) {
            if ($keyword !== null) {
                $query =
                    "
			SELECT u.id,  u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id = l.id AND u.level_id != '1' AND u.level_id != '2' and (u.username LIKE '%$keyword%' OR l.level LIKE '%$keyword%') limit $start, $limit
		";
            } else {
                $query =
                    "
			SELECT u.id,  u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id != '1' AND u.level_id != '2' AND u.level_id = l.id limit $start, $limit
		";
            }
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }
}
