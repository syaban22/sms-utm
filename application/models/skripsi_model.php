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
(SELECT d.nama FROM dosen d, skripsi sk WHERE d.nip = sk.dosbing_2 AND sk.id=s.id GROUP BY d.nip) as dosbing2,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
		";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi sk WHERE d.nip = sk.dosbing_2 AND sk.id=s.id GROUP BY d.nip) as dosbing2,
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
(SELECT d.nama FROM dosen d, skripsi sk WHERE d.nip = sk.dosbing_2 AND sk.id=s.id GROUP BY d.nip) as dosbing2,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
		";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul, m.nama, s.nim, d.nama as dosbing1,
(SELECT d.nama FROM dosen d, skripsi sk WHERE d.nip = sk.dosbing_2 AND sk.id=s.id GROUP BY d.nip) as dosbing2,
p.prodi, s.nilai
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi limit $start, $limit
		";
            }
        }

        if ($user == 4) {
            $nim = $this->session->userdata('username');
            if ($keyword !== null) {
                $query =
                    "
                SELECT s.id, s.judul,s.abstract, m.nama, s.nim, d.nama as dosbing1,
                (SELECT d.nama
                FROM dosen d, skripsi sk
                WHERE d.nip = sk.dosbing_2 AND sk.id=s.id AND sk.nim = $nim) as dosbing2,
                p.prodi, s.nilai,
                (SELECT st.ket
                FROM skripsi sk, status st
                WHERE sk.status = st.id AND sk.id=s.id AND sk.nim = $nim) as status
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.nim = $nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.nim LIKE '%$keyword%' limit $start, $limit
    ";
            } else {
                $query =
                    "
                    SELECT s.id, s.judul,s.abstract, m.nama, s.nim, d.nama as dosbing1,
                    (SELECT d.nama
                    FROM dosen d, skripsi sk
                    WHERE d.nip = sk.dosbing_2 AND sk.id=s.id AND sk.nim = $nim) as dosbing2,
                    p.prodi, s.nilai,
                    (SELECT st.ket
                    FROM skripsi sk, status st
                    WHERE sk.status = st.id AND sk.id=s.id AND sk.nim = $nim) as status
FROM mahasiswa m, dosen d, skripsi s, prodi p
WHERE s.nim = m.nim AND s.nim = $nim AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi limit $start, $limit
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

    public function get_detail($nim_mhs)
    {

        $query = $this->db->query("
        SELECT s.id, s.judul, m.nama, s.abstract, s.nim, d.nama as dosbing1,
        (SELECT d.nama
        FROM dosen d, skripsi sk
        WHERE d.nip = sk.dosbing_2 AND sk.id=s.id AND sk.nim = $nim_mhs) as dosbing2,
        p.prodi, s.nilai, (SELECT s.ket
        FROM skripsi sk, status s
        WHERE sk.status = s.id) as status
FROM mahasiswa m, dosen d, skripsi s, prodi p, status st
WHERE s.nim = m.nim AND s.nim = $nim_mhs AND s.dosbing_1 = d.nip AND p.kode_prodi = s.prodi AND s.status = st.id limit 0, 5
");
        return $query->result_array();
    }

    public function getStatus()
    {
        return $this->db->get('status')->result_array();
    }
}
