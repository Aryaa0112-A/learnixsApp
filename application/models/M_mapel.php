<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mapel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Function to get all subjects
    public function tampil_data()
    {
        return $this->db->get('mapel');
    }

    // Function to get a subject by its ID
    public function get_mapel_by_id($id_mapel)
    {
        return $this->db->get_where('mapel', ['id_mapel' => $id_mapel])->row();
    }

    // Function to update a subject by its ID
    public function update_mapel($id_mapel, $data)
    {
        $this->db->where('id_mapel', $id_mapel);
        return $this->db->update('mapel', $data);
    }

    // Function to delete a subject by its ID
    public function delete_mapel($id_mapel)
    {
        $this->db->where('id_mapel', $id_mapel);
        return $this->db->delete('mapel');
    }

    // You can add more functions here for adding, editing, deleting subjects etc.

    public function get_mapel_by_nip($nip)
    {
        $this->db->select('mapel.*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_mapel = mapel.id_mapel');
        $this->db->where('guru.nip', $nip);
        return $this->db->get()->result();
    }
} 