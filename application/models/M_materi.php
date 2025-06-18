<?php

class M_materi extends CI_Model
{
    public function tampil_data()
    {
        $this->db->select('*');
        $query = $this->db->get('materi');
        error_log("Materi data: " . print_r($query->result(), true));
        return $query;
    }

    public function belajar($id_materi = null)
    {
        $query = $this->db->get_where('materi', array('id_materi' => $id_materi))->row();
        return $query;
    }

    public function detail_materi($id_materi = null)
    {
        $query = $this->db->get_where('materi', array('id_materi' => $id_materi))->row();
        return $query;
    }

    public function delete_materi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_materi($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    
    public function get_materi_by_kelas($id_kelas)
    {
        // Filter the 'materi' table directly using the class ID
        $this->db->where('id_kelas', $id_kelas);
    
        return $this->db->get('materi')->result();
    }

    public function get_mapel_by_id($id_materi)           
    {
        $this->db->where('id_materi', $id_materi);
        return $this->db->get('materi')->row();
    }
}
