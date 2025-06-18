<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_diskusi extends CI_Model
{
    public function get_diskusi_by_materi($id_materi)
    {
        $this->db->select('ruang_diskusi.*, siswa.nama, guru.nama_guru');
        $this->db->from('ruang_diskusi');
        $this->db->join('siswa', 'siswa.id_siswa = ruang_diskusi.id_siswa', 'left');
        $this->db->join('guru', 'guru.nip = ruang_diskusi.nip', 'left');
        $this->db->where('ruang_diskusi.id_materi', $id_materi);
        $this->db->order_by('ruang_diskusi.tanggal_kirim', 'ASC');
        return $this->db->get()->result();
    }

    public function tambah_diskusi($data)
    {
        return $this->db->insert('ruang_diskusi', $data);
    }

    public function hapus_diskusi($id_diskusi)
    {
        $this->db->where('id_diskusi', $id_diskusi);
        return $this->db->delete('ruang_diskusi');
    }
} 