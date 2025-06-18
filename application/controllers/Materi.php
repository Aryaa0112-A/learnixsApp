<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_materi');
        $this->load->model('M_tugas');
        $this->load->model('M_diskusi');
    }

    public function belajar($id)
    {
        $data['title'] = 'Belajar Materi';
        $data['user'] = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
        $data['guru'] = $this->db->get_where('guru', ['nip' => $this->session->userdata('nip')])->row_array();
        $data['detail'] = $this->M_materi->belajar($id);
        $data['materi'] = $this->M_materi->belajar($id);
        $data['tugas'] = $this->M_tugas->get_tugas_by_materi($id);
        $data['pengumpulan'] = $this->M_tugas->get_pengumpulan_by_materi($id);
        $data['nilai'] = $this->M_tugas->get_nilai_by_materi($id);
        $data['diskusi'] = $this->M_diskusi->get_diskusi_by_materi($id);
        
        $this->load->view('template/nav_user.php', $data);
        $this->load->view('materi/belajar', $data);
        $this->load->view('template/footer');
    }

}