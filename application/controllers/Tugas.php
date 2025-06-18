<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_tugas');
        $this->load->library('session');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('user/tugas');
        }
    }

    public function index() {
        $data['title'] = 'Daftar Tugas';
        $data['user'] = $this->session->userdata();
        
        // Get tasks based on user's class
        $data['tugas'] = $this->M_tugas->get_tugas_by_kelas($data['user']['kelas'])->result();
        
        // Get task status for each task
        foreach ($data['tugas'] as &$tugas) {
            $status = $this->M_tugas->get_status_tugas($tugas->id_tugas, $data['user']['id_siswa']);
            if ($status) {
                $tugas->status = $status->status;
            } else {
                // Check if task is late
                if (strtotime($tugas->deadline) < time()) {
                    $tugas->status = 'terlambat';
                } else {
                    $tugas->status = 'belum';
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/tugas', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_tugas) {
        $data['title'] = 'Detail Tugas';
        $data['user'] = $this->session->userdata();
        
        // Get task details
        $data['tugas'] = $this->M_tugas->get_tugas_by_id($id_tugas);
        if (!$data['tugas']) {
            show_404();
        }
        
        // Get submission status
        $data['submission'] = $this->M_tugas->get_status_tugas($id_tugas, $data['user']['id_siswa']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/detail_tugas', $data);
        $this->load->view('templates/footer');
    }

    public function submit($id_tugas) {
        $data['title'] = 'Kumpul Tugas';
        $data['user'] = $this->session->userdata();
        
        // Get task details
        $data['tugas'] = $this->M_tugas->get_tugas_by_id($id_tugas);
        if (!$data['tugas']) {
            show_404();
        }

        // Check if task is already submitted
        $submission = $this->M_tugas->get_status_tugas($id_tugas, $data['user']['id_siswa']);
        if ($submission) {
            $this->session->set_flashdata('error', 'Anda sudah mengumpulkan tugas ini');
            redirect('tugas/detail/' . $id_tugas);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/submit_tugas', $data);
        $this->load->view('templates/footer');
    }

    public function process_submit() {
        $id_tugas = $this->input->post('id_tugas');
        $id_siswa = $this->session->userdata('id_siswa');
        
        // Upload file
        $config['upload_path'] = './assets/tugas/';
        $config['allowed_types'] = 'pdf|doc|docx|zip|rar|png|jpg|jpeg';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'tugas_' . $id_tugas . '_' . $id_siswa . '_' . time();
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = FALSE;

        // Create the upload directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        // Ensure directory is writable
        if (!is_writable($config['upload_path'])) {
            chmod($config['upload_path'], 0777);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_tugas')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('tugas/submit/' . $id_tugas);
        }

        $file_data = $this->upload->data();
        
        // Prepare submission data
        $submission_data = array(
            'id_tugas' => $id_tugas,
            'id_siswa' => $id_siswa,
            'file_submission' => $file_data['file_name'],
            'tanggal_submit' => date('Y-m-d H:i:s'),
            'status' => 'sudah'
        );

        // Save submission
        if ($this->M_tugas->submit_tugas($submission_data)) {
            $this->session->set_flashdata('success', 'Tugas berhasil dikumpulkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengumpulkan tugas');
        }

        redirect('tugas/detail/' . $id_tugas);
    }

    public function download($id_tugas) {
        $tugas = $this->M_tugas->get_tugas_by_id($id_tugas);
        if (!$tugas) {
            show_404();
        }

        $file_path = './uploads/tugas/' . $tugas->file_tugas;
        if (file_exists($file_path)) {
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            $this->session->set_flashdata('error', 'File tidak ditemukan');
            redirect('tugas/detail/' . $id_tugas);
        }
    }
} 