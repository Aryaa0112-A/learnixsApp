<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, guru.nama_guru, materi.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left');
        $this->db->join('guru', 'guru.nip = jadwal.nip', 'left');
        $this->db->join('materi', 'materi.id_materi = jadwal.id_materi', 'left');
        return $this->db->get();
    }

    public function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function detail_jadwal($id_jadwal = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, guru.nama_guru, materi.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left');
        $this->db->join('guru', 'guru.nip = jadwal.nip', 'left');
        $this->db->join('materi', 'materi.id_materi = jadwal.id_materi', 'left');
        $this->db->where('jadwal.id_jadwal', $id_jadwal);
        return $this->db->get()->row();
    }

    public function update_jadwal($where, $table)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, guru.nama_guru, materi.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left');
        $this->db->join('guru', 'guru.nip = jadwal.nip', 'left');
        $this->db->join('materi', 'materi.id_materi = jadwal.id_materi', 'left');
        $this->db->where($where);
        return $this->db->get();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_jadwal($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_jadwal_by_kelas($id_kelas)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, guru.nama_guru, materi.nama_mapel');
        $this->db->from('jadwal');
        $this->db->join('kelas', 'kelas.id_kelas = jadwal.id_kelas', 'left');
        $this->db->join('guru', 'guru.nip = jadwal.nip', 'left');
        $this->db->join('materi', 'materi.id_materi = jadwal.id_materi', 'left');
        $this->db->where('jadwal.id_kelas', $id_kelas);
        return $this->db->get()->result();
    }
} 