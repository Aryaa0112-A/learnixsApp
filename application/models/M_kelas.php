<?php

class M_kelas extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('kelas');
    }

    public function detail_kelas($id = null)
    {
        $query = $this->db->get_where('kelas', array('id_kelas' => $id))->row();
        return $query;
    }

    public function delete_kelas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_kelas($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // Get total number of classes
    public function get_total_kelas()
    {
        return $this->db->count_all('kelas');
    }

    // Get class details with student count
    public function get_kelas_with_student_count()
    {
        $this->db->select('k.id_kelas, k.nama_kelas, k.nip, g.nama_guru, COUNT(s.id_siswa) as jumlah_siswa');
        $this->db->from('kelas k');
        $this->db->join('siswa s', 's.id_kelas = k.id_kelas', 'left');
        $this->db->join('guru g', 'g.nip = k.nip', 'left');
        $this->db->group_by('k.id_kelas, k.nama_kelas, k.nip, g.nama_guru');
        return $this->db->get()->result();
    }

    // Get class details with teacher information
    public function get_kelas_with_guru($nip = null)
    {
        $this->db->select('kelas.id_kelas, kelas.nama_kelas, kelas.jumlah_siswa, guru.nama_guru');
        $this->db->from('kelas');
        $this->db->join('guru', 'guru.nip = kelas.nip', 'left');
        if ($nip) {
            $this->db->where('kelas.nip', $nip);
        }
        return $this->db->get()->result();
    }

    // Get class schedule information
    public function get_jadwal_kelas($kelas_id)
    {
        $this->db->select('jadwal.*, guru.nama_guru, materi.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('guru', 'guru.nip = jadwal.nip', 'left');
        $this->db->join('materi', 'materi.id = jadwal.materi_id', 'left');
        $this->db->where('jadwal.kelas_id', $kelas_id);
        return $this->db->get()->result();
    }

    // Get classes taught by a specific teacher based on schedule
    public function get_classes_by_teacher_schedule($nip)
    {
        // First, get distinct class IDs from the jadwal table for the given teacher
        $this->db->select('id_kelas');
        $this->db->from('jadwal');
        $this->db->where('nip', $nip);
        $this->db->group_by('id_kelas');
        $query = $this->db->get();
        $class_ids = [];
        foreach ($query->result() as $row) {
            $class_ids[] = $row->id_kelas;
        }

        // If class IDs are found, fetch the full class details from the kelas table
        if (!empty($class_ids)) {
            $this->db->select('id_kelas, nama_kelas, jumlah_siswa');
            $this->db->from('kelas');
            $this->db->where_in('id_kelas', $class_ids);
            return $this->db->get()->result();
        } else {
            return []; // No classes found for this teacher
        }
    }
}
