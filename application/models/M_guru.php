<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_guru extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('guru.*, mapel.nama_mapel');
        $this->db->from('guru');
        $this->db->join('mapel', 'guru.nama_mapel = mapel.nama_mapel', 'left');
        return $this->db->get();
    }

    public function detail_guru($nip)
    {
        $this->db->select('guru.*, mapel.nama_mapel');
        $this->db->from('guru');
        $this->db->join('mapel', 'guru.nama_mapel = mapel.nama_mapel', 'left');
        $this->db->where('guru.nip', $nip);
        return $this->db->get()->row();
    }

    public function getByEmail($email)
    {
        return $this->db->get_where('guru', ['email' => $email]);
    }

    public function delete_guru($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_guru($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
