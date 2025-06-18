<?php

class M_tugas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_tugas_by_kelas($kelas)
    {
        $this->db->select('t.*, m.nama_mapel, COUNT(spg.id_soal) as jumlah_soal_pilihan_ganda');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('soal_pilihan_ganda spg', 'spg.id_tugas = t.id_tugas', 'left');
        $this->db->where('t.kelas', $kelas);
        $this->db->group_by('t.id_tugas');
        $this->db->order_by('t.deadline', 'ASC');
        return $this->db->get();
    }

    public function get_tugas_by_mapel($id_mapel, $kelas)
    {
        $this->db->select('t.*, m.nama_mapel');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->where('t.id_mapel', $id_mapel);
        $this->db->where('t.kelas', $kelas);
        $this->db->order_by('t.deadline', 'ASC');
        return $this->db->get();
    }

    public function get_tugas_by_id($id_tugas)
    {
        $this->db->select('t.*, m.nama_mapel, k.nama_kelas');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel', 'left');
        $this->db->join('kelas k', 'k.nama_kelas = t.kelas', 'left');
        $this->db->where('t.id_tugas', $id_tugas);
        return $this->db->get()->row();
    }

    public function get_status_tugas($id_tugas, $id)
    {
        $this->db->select('s.status, s.nilai, s.komentar, s.tanggal_submit, s.file_submission');
        $this->db->from('submission_tugas s');
        $this->db->where('s.id_tugas', $id_tugas);
        $this->db->where('s.id_siswa', $id);
        return $this->db->get()->row();
    }

    public function submit_tugas($data)
    {
        return $this->db->insert('submission_tugas', $data);
    }

    public function update_submission($id_submission, $data)
    {
        $this->db->where('id_submission', $id_submission);
        return $this->db->update('submission_tugas', $data);
    }

    public function get_tugas_terlambat($id)
    {
        $this->db->select('t.*, m.nama_mapel');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('submission_tugas s', 's.id_tugas = t.id_tugas AND s.id_siswa = ' . $id, 'left');
        $this->db->where('t.deadline < NOW()');
        $this->db->where('s.id_submission IS NULL');
        return $this->db->get();
    }

    public function get_tugas_belum_dikerjakan($id)
    {
        $this->db->select('t.*, m.nama_mapel');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('submission_tugas s', 's.id_tugas = t.id_tugas AND s.id_siswa = ' . $id, 'left');
        $this->db->where('s.id_submission IS NULL');
        $this->db->where('t.deadline > NOW()');
        return $this->db->get();
    }

    public function get_tugas_sudah_dikerjakan($id)
    {
        $this->db->select('t.*, m.nama_mapel, s.tanggal_submit, s.nilai');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('submission_tugas s', 's.id_tugas = t.id_tugas');
        $this->db->where('s.id_siswa', $id);
        return $this->db->get();
    }

    public function delete_tugas($id_tugas)
    {
        // Delete submissions first
        $this->db->where('id_tugas', $id_tugas);
        $this->db->delete('submission_tugas');
        
        // Then delete the task
        $this->db->where('id_tugas', $id_tugas);
        return $this->db->delete('tugas');
    }

    public function update_tugas($id_tugas, $data)
    {
        $this->db->where('id_tugas', $id_tugas);
        return $this->db->update('tugas', $data);
    }

    public function add_tugas($data)
    {
        $this->db->insert('tugas', $data);
        return $this->db->insert_id();
    }

    public function tampil_data()
    {
        $this->db->select('tugas.*, mapel.nama_mapel');
        $this->db->from('tugas');
        $this->db->join('mapel', 'mapel.id_mapel = tugas.id_mapel', 'left');
        return $this->db->get();
    }

    public function tampil_data_by_guru($nip)
    {
        $this->db->select('tugas.*, mapel.nama_mapel');
        $this->db->from('tugas');
        $this->db->join('mapel', 'mapel.id_mapel = tugas.id_mapel', 'left');
        $this->db->join('guru', 'guru.id_mapel = mapel.id_mapel', 'left');
        $this->db->where('guru.nip', $nip);
        return $this->db->get();
    }

    public function tugas($id_tugas = null)
    {
        $query = $this->db->get_where('tugas', array('id_tugas' => $id_tugas))->row();
        return $query;
    }

    public function detail_tugas($id_tugas = null)
    {
        $this->db->select('tugas.*, mapel.nama_mapel, kelas.nama_kelas');
        $this->db->from('tugas');
        $this->db->join('mapel', 'mapel.id_mapel = tugas.id_mapel', 'left');
        $this->db->join('kelas', 'kelas.nama_kelas = tugas.kelas', 'left');
        $this->db->where('tugas.id_tugas', $id_tugas);
        $query = $this->db->get()->row();
        return $query;
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    
    public function get_submissions_by_tugas($id_tugas)
    {
        $this->db->select('submission_tugas.*, siswa.nama');
        $this->db->from('submission_tugas');
        $this->db->join('siswa', 'siswa.id_siswa = submission_tugas.id_siswa');
        $this->db->where('submission_tugas.id_tugas', $id_tugas);
        return $this->db->get()->result();
    }

    public function get_tugas_by_guru($id_mapel)
    {
        $this->db->select('tugas.*, mapel.nama_mapel');
        $this->db->from('tugas');
        $this->db->join('mapel', 'mapel.id_mapel = tugas.id_mapel', 'left');
        $this->db->where('tugas.id_mapel', $id_mapel);
        $this->db->order_by('tugas.deadline', 'DESC');
        return $this->db->get();
    }

    public function update_nilai($id_submission, $data)
    {
        $this->db->where('id_submission', $id_submission);
        return $this->db->update('submission_tugas', $data);
    }

    public function get_tugas_by_materi($id_materi)
    {
        $this->db->select('t.*, m.nama_mapel');
        $this->db->from('tugas t');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('materi mat', 'mat.id_mapel = m.id_mapel');
        $this->db->where('mat.id_materi', $id_materi);
        $this->db->order_by('t.deadline', 'ASC');
        return $this->db->get()->result();
    }

    public function get_pengumpulan_by_materi($id_materi)
    {
        $this->db->select('s.*, t.judul_tugas, siswa.nama');
        $this->db->from('submission_tugas s');
        $this->db->join('tugas t', 't.id_tugas = s.id_tugas');
        $this->db->join('siswa', 'siswa.id_siswa = s.id_siswa');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('materi mat', 'mat.id_mapel = m.id_mapel');
        $this->db->where('mat.id_materi', $id_materi);
        return $this->db->get()->result();
    }

    public function get_nilai_by_materi($id_materi)
    {
        $this->db->select('s.*, t.judul_tugas, siswa.nama');
        $this->db->from('submission_tugas s');
        $this->db->join('tugas t', 't.id_tugas = s.id_tugas');
        $this->db->join('siswa', 'siswa.id_siswa = s.id_siswa');
        $this->db->join('mapel m', 'm.id_mapel = t.id_mapel');
        $this->db->join('materi mat', 'mat.id_mapel = m.id_mapel');
        $this->db->where('mat.id_materi', $id_materi);
        $this->db->where('s.nilai IS NOT NULL');
        return $this->db->get()->result();
    }
}
