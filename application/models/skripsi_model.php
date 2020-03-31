<?php
defined('BASEPATH') or exit('No direct script access allowed');

class skripsi_model extends CI_Model
{
    public function getSkripsi($limit, $start, $keyword = null, $user)
    {
        if ($user == 1) {
            if ($keyword !== null) {
                $query =
                    "
			SELECT u.id, u.nama, u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id = l.id and u.username LIKE '%$keyword%' limit $start, $limit
		";
            } else {
                $query =
                    "
			SELECT u.id, u.nama, u.username, u.level_id, l.level as level FROM user u, user_level l WHERE u.level_id = l.id limit $start, $limit
		";
            }
        }
        if (($user == 2)) {
            if ($keyword !== null) {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi s WHERE d.nip = s.dosbing_2 GROUP BY d.nip) as dosbing2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji1 = d.nip) as dosen_uji1,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji2 = d.nip) as dosen_uji2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji3 = d.nip) as dosen_uji3,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
		";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi s WHERE d.nip = s.dosbing_2 GROUP BY d.nip) as dosbing2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji1 = d.nip) as dosen_uji1,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji2 = d.nip) as dosen_uji2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji3 = d.nip) as dosen_uji3,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi limit $start, $limit
		";
            }
        }
        if (($user == 3)) {
            if ($keyword !== null) {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi s WHERE d.nip = s.dosbing_2 GROUP BY d.nip) as dosbing2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji1 = d.nip) as dosen_uji1,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji2 = d.nip) as dosen_uji2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji3 = d.nip) as dosen_uji3,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
		";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi s WHERE d.nip = s.dosbing_2 GROUP BY d.nip) as dosbing2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji1 = d.nip) as dosen_uji1,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji2 = d.nip) as dosen_uji2,
(SELECT d.nama FROM dosen d, skripsi s WHERE s.dosen_uji3 = d.nip) as dosen_uji3,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi limit $start, $limit
		";
            }
        }

        if ($user == 4) {
            if ($keyword !== null) {
                $query =
                    "
                SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1, (SELECT d.nama
                                        FROM dosen d, skripsi s
                                        WHERE d.nip = s.dosbing_2) as dosbing2, (SELECT d.nama
                                                                                FROM dosen d, skripsi s
                                                                                WHERE s.dosen_uji1 = d.nip) as dosen_uji1, (SELECT d.nama
                                                                                FROM dosen d, skripsi s
                                                                                WHERE s.dosen_uji2 = d.nip) as dosen_uji2, (SELECT d.nama
                                                                                FROM dosen d, skripsi s
                                                                                WHERE s.dosen_uji3 = d.nip) as dosen_uji3,p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
    ";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1, (SELECT d.nama
                                            FROM dosen d, skripsi s
                                            WHERE d.nip = s.dosbing_2) as dosbing2, (SELECT d.nama
                                                                                    FROM dosen d, skripsi s
                                                                                    WHERE s.dosen_uji1 = d.nip) as dosen_uji1, (SELECT d.nama
                                                                                    FROM dosen d, skripsi s
                                                                                    WHERE s.dosen_uji2 = d.nip) as dosen_uji2, (SELECT d.nama
                                                                                    FROM dosen d, skripsi s
                                                                                    WHERE s.dosen_uji3 = d.nip) as dosen_uji3,p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi limit $start, $limit
		";
            }
        }
        return $this->db->query($query, $limit, $start, $keyword)->result_array();
    }

    public function getPenguji()
    {
        $query =
            "
                SELECT d.nip, d.nama

                FROM dosen d
                
                WHERE d.nip NOT IN (
                    SELECT s.dosbing_2
                    from skripsi s
                    ) AND d.nip NOT IN (
                    SELECT s.dosbing_1
                    from skripsi s)
		";

        return $this->db->query($query)->result_array();
    }
}
