<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_PilihanGanda extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk mendapatkan semua soal pilihan ganda berdasarkan NIP guru
    public function get_all_soal_by_guru($nip)
    {
        $this->db->select('spg.*, m.nama_mapel, t.judul_tugas');
        $this->db->from('soal_pilihan_ganda spg');
        $this->db->join('mapel m', 'm.id_mapel = spg.id_mapel');
        $this->db->join('tugas t', 't.id_tugas = spg.id_tugas', 'left');
        $this->db->where('spg.nip', $nip);
        $this->db->order_by('spg.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Fungsi untuk mendapatkan detail soal pilihan ganda berdasarkan ID soal
    public function get_soal_by_id($id_soal)
    {
        $this->db->select('spg.*, pj.pilihan_a, pj.pilihan_b, pj.pilihan_c, pj.pilihan_d, m.nama_mapel, t.judul_tugas');
        $this->db->from('soal_pilihan_ganda spg');
        $this->db->join('pilihan_jawaban pj', 'pj.id_soal = spg.id_soal');
        $this->db->join('mapel m', 'm.id_mapel = spg.id_mapel');
        $this->db->join('tugas t', 't.id_tugas = spg.id_tugas', 'left');
        $this->db->where('spg.id_soal', $id_soal);
        return $this->db->get()->row();
    }

    // Fungsi untuk menambahkan soal pilihan ganda dan pilihan jawabannya
    public function add_soal_pilihan_ganda($soal_data, $pilihan_data)
    {
        $this->db->trans_start();

        // Set created_at and updated_at timestamps
        $soal_data['created_at'] = date('Y-m-d H:i:s');
        $soal_data['updated_at'] = date('Y-m-d H:i:s');

        // Pastikan id_soal tidak pernah dikirim ke insert
        if (isset($soal_data['id_soal'])) {
            unset($soal_data['id_soal']);
        }

        // Insert ke tabel soal_pilihan_ganda
        $this->db->insert('soal_pilihan_ganda', $soal_data);
        
        // Ambil ID yang baru di-generate
        $soal_id = $this->db->insert_id();
        
        if ($soal_id) {
            // Set id_soal untuk pilihan jawaban
            $pilihan_data['id_soal'] = $soal_id;
            $this->db->insert('pilihan_jawaban', $pilihan_data);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    // Fungsi untuk memperbarui soal pilihan ganda dan pilihan jawabannya
    public function update_soal_pilihan_ganda($id_soal, $soal_data, $pilihan_data)
    {
        $this->db->trans_start();
        
        // Set updated_at timestamp
        $soal_data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id_soal', $id_soal);
        $this->db->update('soal_pilihan_ganda', $soal_data);

        $this->db->where('id_soal', $id_soal);
        $this->db->update('pilihan_jawaban', $pilihan_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    // Fungsi untuk menghapus soal pilihan ganda dan pilihan jawabannya
    public function delete_soal_pilihan_ganda($id_soal)
    {
        $this->db->trans_start();
        // Delete choices first due to foreign key constraint
        $this->db->where('id_soal', $id_soal);
        $this->db->delete('pilihan_jawaban');

        $this->db->where('id_soal', $id_soal);
        $this->db->delete('soal_pilihan_ganda');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    // Fungsi untuk mendapatkan semua soal pilihan ganda berdasarkan ID tugas
    public function get_soal_by_tugas($id_tugas)
    {
        $this->db->select('spg.*, pj.pilihan_a, pj.pilihan_b, pj.pilihan_c, pj.pilihan_d');
        $this->db->from('soal_pilihan_ganda spg');
        $this->db->join('pilihan_jawaban pj', 'pj.id_soal = spg.id_soal');
        $this->db->where('spg.id_tugas', $id_tugas);
        $this->db->order_by('spg.id_soal', 'ASC'); // Order by ID to ensure consistent order
        return $this->db->get()->result();
    }
} 