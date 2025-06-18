<?php

class M_siswa extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('siswa.*, kelas.nama_kelas');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        return $this->db->get();
    }

    public function detail_siswa($id_siswa = null)
    {
        $query = $this->db->get_where('siswa', array('id_siswa' => $id_siswa))->row();
        return $query;
    }

    public function delete_siswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_siswa($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function get_siswa_by_kelas($id_kelas)
    {
        $this->db->select('siswa.*, kelas.nama_kelas');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas', 'left');
        $this->db->where('siswa.id_kelas', $id_kelas);
        return $this->db->get()->result();
    }
}
