<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskusi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_diskusi');
        $this->load->model('M_materi');
        
        // Check if user is logged in
        if (!$this->session->userdata('email')) {
            redirect('welcome');
        }
    }

    public function index($id_materi)
    {
        $data['user'] = $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array();
        $is_siswa = false;
        if ($data['user']) {
            $is_siswa = true;
        } else {
            $data['user'] = $this->db->get_where('guru', ['email' => $this->session->userdata('email')])->row_array();
        }

        $data['materi'] = $this->M_materi->detail_materi($id_materi);
        $data['diskusi'] = $this->M_diskusi->get_diskusi_by_materi($id_materi);
        
        if ($is_siswa) {
            $this->load->view('template/nav_user.php', $data);
            $this->load->view('diskusi/index', $data);
            $this->load->view('template/footer');
        } else {
            $this->load->view('template_guru/nav', $data);
            $this->load->view('diskusi/index', $data);
            $this->load->view('template_guru/footer');
        }
    }

    public function tambah()
    {
        $id_materi = $this->input->post('id_materi');
        $pesan = $this->input->post('pesan');
        
        // Check if user is siswa or guru
        $siswa = $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array();
        $guru = $this->db->get_where('guru', ['email' => $this->session->userdata('email')])->row_array();
        
        $data = [
            'id_materi' => $id_materi,
            'pesan' => $pesan,
            'tanggal_kirim' => date('Y-m-d H:i:s')
        ];
        
        if ($siswa) {
            $data['id_siswa'] = $siswa['id_siswa'];
            // Tidak perlu mengatur nip karena akan diabaikan oleh database
        } else if ($guru) {
            $data['nip'] = $guru['nip'];
            // Tidak perlu mengatur id_siswa karena akan diabaikan oleh database
        }
        
        // Debug: Print data being inserted
        log_message('debug', 'Data being inserted to ruang_diskusi: ' . print_r($data, true));
        
        if ($this->M_diskusi->tambah_diskusi($data)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dikirim');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim pesan');
        }
        
        redirect('diskusi/index/' . $id_materi);
    }

    public function hapus($id_diskusi, $id_materi)
    {
        if ($this->M_diskusi->hapus_diskusi($id_diskusi)) {
            $this->session->set_flashdata('success', 'Pesan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pesan');
        }
        
        redirect('diskusi/index/' . $id_materi);
    }
} 