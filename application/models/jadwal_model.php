<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jadwal_model extends CI_Model
{
    public function getJadwalSempro($limit, $start, $keyword = null, $user, $nim, $nip)
    {
        if (($user == 2)) {
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id 
                GROUP BY js.id limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND s.judul LIKE '%$keyword%'
                GROUP BY js.id limit $start, $limit
                ");
            }
        }
        if (($user == 4)) {
            $query = $this->db->query("
            SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode,
            js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3, js.ruangan
            FROM jadwal_sempro js, skripsi s, dosen d, mahasiswa m
            WHERE s.nim=m.nim AND s.nim=$nim AND s.id = js.id_skripsi AND s.status=2
            GROUP BY js.id
            ");
        }
        return $query->result_array();
    }

    public function getJadwalSidang($limit, $start, $keyword = null, $user, $nim, $nip)
    {
        if (($user == 2)) {
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,
                js.ruangan,s.nilai
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id
                GROUP BY js.id limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,
                js.ruangan,s.nilai
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND s.judul LIKE '%$keyword%'
                 GROUP BY js.id limit $start, $limit
                ");
            }
        }
        if (($user == 3)) {
            //Query masih belum menampilkan berdasarkan dosen yang terlibat di dalam jadwal secara spesifik
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,
                js.ruangan,s.nilai
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND (js.penguji_1=$nip OR js.penguji_2=$nip OR js.penguji_3=$nip)
                GROUP BY js.id limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode,
                js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
                (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,
                js.ruangan,s.nilai
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND (js.penguji_1=$nip OR js.penguji_2=$nip OR js.penguji_3=$nip) AND s.judul LIKE '%$keyword%'
                GROUP BY js.id limit $start, $limit
                ");
            }
        }
        if (($user == 4)) {
            $query = $this->db->query("
            SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode,
            js.penguji_1 as nip1,js.penguji_2 as nip2,js.penguji_3 as nip3,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_1) AS penguji1,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2,
            (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) AS penguji3,
            js.ruangan,s.nilai
            FROM jadwal_sidang js, skripsi s, dosen d, mahasiswa m
            WHERE s.nim=m.nim AND s.nim=$nim AND s.id = js.id_skripsi
            GROUP BY js.id
            ");
        }
        return $query->result_array();
    }
    public function pengujisempro($limit, $start, $keyword = null, $user,  $nip){
        if (($user == 3)) {
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND (js.penguji_1=$nip or js.penguji_2=$nip or js.penguji_3=$nip) AND s.status = 2
                GROUP BY js.id limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, js.id_skripsi, s.judul, s.status, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND (js.penguji_1=$nip or js.penguji_2=$nip or js.penguji_3=$nip) AND s.status = 2 
                AND s.judul LIKE '%$keyword%' 
                GROUP BY js.id limit $start, $limit
                ");
            }
            return $query->result_array();
        }
    }
}
