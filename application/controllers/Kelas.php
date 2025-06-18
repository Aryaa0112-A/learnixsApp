<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kelas');
        $this->load->model('M_jadwal');
        $this->load->model('M_materi');
        $this->load->model('M_siswa');
        $this->load->model('M_guru');
        $this->load->helper('url');
        
        // Check if user is logged in
        if (!$this->session->userdata('email')) {
            redirect('welcome');
        }
        
        // Get user data
        $this->user_data = $this->db->get_where('guru', ['email' => $this->session->userdata('email')])->row_array();
        if (!$this->user_data) {
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['user'] = $this->user_data;
        $data['total_kelas'] = $this->M_kelas->get_total_kelas();
        $data['kelas_list'] = $this->M_kelas->get_kelas_with_student_count();
        
        $this->load->view('template_guru/nav', $data);
        $this->load->view('guru/data_kelas', $data);
        $this->load->view('template_guru/footer');
    }

    public function detail($id_kelas)
    {
        $data['user'] = $this->user_data;
        $data['kelas'] = $this->M_kelas->detail_kelas($id_kelas);
        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($id_kelas);
        $data['siswa_list'] = $this->M_siswa->get_siswa_by_kelas($id_kelas);
        
        $this->load->view('template_guru/nav', $data);
        $this->load->view('guru/detail_kelas', $data);
        $this->load->view('template_guru/footer');
    }

    public function jadwal_kelas($id_kelas)
    {
        $data['user'] = $this->user_data;
        $data['kelas'] = $this->M_kelas->detail_kelas($id_kelas);
        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($id_kelas);
        
        $this->load->view('template_guru/nav', $data);
        $this->load->view('guru/jadwal_kelas', $data);
        $this->load->view('template_guru/footer');
    }

    public function kelas_saya()
    {
        $data['user'] = $this->user_data;
        $nip = $data['user']['nip'];

        $data['kelas_list'] = $this->M_kelas->get_classes_by_teacher_schedule($nip);
        
        $this->load->view('template_guru/nav', $data);
        $this->load->view('guru/kelas_saya', $data);
        $this->load->view('template_guru/footer');
    }
}
