<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jadwal_model extends CI_Model
{
    public function getJadwalSempro($limit, $start, $keyword = null, $user, $nim, $nip)
    {
        if (($user == 2)) {
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 AND s.judul LIKE '%$keyword%' limit $start, $limit
                ");
            }
        }
        if (($user == 3)) {
            //Query masih belum menampilkan berdasarkan dosen yang terlibat di dalam jadwal secara spesifik
            if ($keyword == null) {
                $query = $this->db->query("
                    SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                    FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sempro js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 AND s.judul LIKE '%$keyword%' limit $start, $limit
                ");
            }
        }
        if (($user == 4)) {
            $query = $this->db->query("
            SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
            FROM jadwal_sempro js, skripsi s, dosen d, mahasiswa m
            WHERE s.nim=m.nim AND s.nim=$nim AND s.id = js.id_skripsi AND d.nip = js.penguji_1
            ");
        }
        return $query->result_array();
    }

    public function getJadwalSidang($limit, $start, $keyword = null, $user, $nim, $nip)
    {
        if (($user == 2)) {
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 AND s.judul LIKE '%$keyword%' limit $start, $limit
                ");
            }
        }
        if (($user == 3)) {
            //Query masih belum menampilkan berdasarkan dosen yang terlibat di dalam jadwal secara spesifik
            if ($keyword == null) {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 limit $start, $limit
                ");
            } else {
                $query = $this->db->query("
                SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
                FROM jadwal_sidang js, skripsi s, dosen d
                WHERE js.id_skripsi = s.id AND d.nip = js.penguji_1 AND s.judul LIKE '%$keyword%' limit $start, $limit
                ");
            }
        }
        if (($user == 4)) {
            $query = $this->db->query("
            SELECT js.id, s.judul, js.tanggal, js.waktu, js.periode, js.penguji_1, js.penguji_2, js.penguji_3, d.nama as penguji1, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_2) AS penguji2, (SELECT d.nama FROM dosen d WHERE d.nip = js.penguji_3) as penguji3, js.ruangan
            FROM jadwal_sidang js, skripsi s, dosen d, mahasiswa m
            WHERE s.nim=m.nim AND s.nim=$nim AND s.id = js.id_skripsi AND d.nip = js.penguji_1
            ");
        }
        return $query->result_array();
    }
}
