<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_jadwal');
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['jadwal'] = $this->m_jadwal->get_all_jadwal();
        $this->load->view('template/header'); // Assuming a header template
        $this->load->view('jadwal/index', $data);
        $this->load->view('template/footer'); // Assuming a footer template
    }

    public function detail($id_jadwal)
    {
        $data['jadwal'] = $this->m_jadwal->get_jadwal_by_id($id_jadwal);
        $this->load->view('template/header');
        $this->load->view('jadwal/detail', $data);
        $this->load->view('template/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('nip', 'NIP Guru', 'required');
        $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required', [
            'required' => 'Mata pelajaran tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            // Load data for dropdowns (kelas, guru, materi) - You'll need to create models for these
            // $data['kelas'] = $this->m_kelas->get_all_kelas();
            // $data['guru'] = $this->m_guru->get_all_guru();
            // $data['materi'] = $this->m_materi->get_all_materi();

            $this->load->view('template/header');
            $this->load->view('jadwal/add'); //, $data);
            $this->load->view('template/footer');
        }
        else
        {
            $data = array(
                'id_kelas' => $this->input->post('id_kelas'),
                'nip' => $this->input->post('nip'),
                'id_mapel' => $this->input->post('id_mapel'),
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai')
            );

            $this->m_jadwal->insert_jadwal($data);
            redirect('jadwal');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('nip', 'NIP Guru', 'required');
        $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required', [
            'required' => 'Mata pelajaran tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['jadwal'] = $this->m_jadwal->get_jadwal_by_id($id);
             // Load data for dropdowns (kelas, guru, materi) - You'll need to create models for these
            // $data['kelas'] = $this->m_kelas->get_all_kelas();
            // $data['guru'] = $this->m_guru->get_all_guru();
            // $data['materi'] = $this->m_materi->get_all_materi();

            $this->load->view('template/header');
            $this->load->view('jadwal/edit', $data); //, $data);
            $this->load->view('template/footer');
        }
        else
        {
            $data = array(
                'id_kelas' => $this->input->post('id_kelas'),
                'nip' => $this->input->post('nip'),
                'id_mapel' => $this->input->post('id_mapel'),
                'hari' => $this->input->post('hari'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai')
            );

            $this->m_jadwal->update_jadwal($id, $data);
            redirect('jadwal');
        }
    }

    public function delete($id)
    {
        $this->m_jadwal->delete_jadwal($id);
        redirect('jadwal');
    }

} 