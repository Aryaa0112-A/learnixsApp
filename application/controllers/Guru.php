<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    protected $user_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'download');
        $this->load->model('M_guru'); // Load the Guru model
        $this->load->model('M_PilihanGanda'); // Load the Multiple Choice Question model

        // Check if user is logged in
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('not-login', 'Gagal!');
            redirect('welcome/guru');
        }

        // Fetch logged-in teacher's data and store it
        $email = $this->session->userdata('email');
        $user_query = $this->M_guru->getByEmail($email);

        if ($user_query->num_rows() > 0) {
            $this->user_data = $user_query->row_array();
        } else {
            $this->user_data = null; // Set to null if user not found
        }

        // Optional: Check if user data was found
        if (!$this->user_data) {
             // Handle case where user data is not found (e.g., redirect or show error)
             $this->session->set_flashdata('not-login', 'Data guru tidak ditemukan!');
             redirect('welcome/guru');
        }
    }

    public function tambah()
    {
        // Use user data fetched in constructor
        $data['guru'] = (object) $this->user_data;
        // Assuming nama_mapel is directly in user_data or needs to be fetched via a relationship
        // If nama_mapel is directly in guru table:
        $data['mapel'] = [isset($this->user_data['nama_mapel']) ? $this->user_data['nama_mapel'] : ''];
        // If you need to fetch mapel details based on an id_mapel in guru table:
        // $id_mapel_guru = $this->user_data['id_mapel'] ?? null;
        // $mapel_list = [];
        // if ($id_mapel_guru) {
        //     $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel_guru])->row_array();
        //     if ($mapel_data) {
        //         $mapel_list[] = $mapel_data;
        //     }
        // }
        // $data['mapel'] = $mapel_list;

        $this->load->view('guru/tugas_form', $data);
    }

    public function index()
    {
        // Use user data fetched in constructor
        $data['user'] = $this->user_data;

        $this->load->view('guru/index', $data);
    }

    public function print_guru(){
        $this->load->model('m_guru');

        $data['user'] = $this->m_guru->tampil_data("guru")->result();
        $this->load->view('admin/print_guru', $data);
    }

    public function data_siswa()
    {
        $this->load->model('m_siswa');

        // Use user data fetched in constructor
        $data['user'] = $this->user_data;

        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('template_guru/nav');
        $this->load->view('guru/data_siswa', $data);
        $this->load->view('template_guru/footer');
    }

    public function detail_siswa($id_siswa)
    {
        $this->load->model('m_siswa');
        $where = array('id_siswa' => $id_siswa);
        $detail = $this->m_siswa->detail_siswa($id_siswa);
        $data['detail'] = $detail;
        $data['user'] = $this->user_data; // Pass user data to view
        $this->load->view('guru/detail_siswa', $data);
    }

    public function add_materi()
    {
        // First, get the form data and set default values if null
        $nama_guru = $this->input->post('nama_guru') ?? '';
        $nama_mapel = $this->input->post('nama_mapel') ?? '';
        $deskripsi = $this->input->post('deskripsi') ?? '';
        $id_kelas = $this->input->post('id_kelas') ?? '';

        // Set validation data with proper null handling
        $validation_data = [
            'nama_guru' => $nama_guru,
            'nama_mapel' => $nama_mapel,
            'deskripsi' => $deskripsi,
            'id_kelas' => $id_kelas
        ];
        $this->form_validation->set_data($validation_data);

        // Set validation rules with proper null handling
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|trim');
        $this->form_validation->set_rules('nama_mapel', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->user_data;
            // Pass the form data back to the view to preserve user input
            $data['form_data'] = [
                'nama_guru' => $nama_guru,
                'nama_mapel' => $nama_mapel,
                'deskripsi' => $deskripsi,
                'id_kelas' => $id_kelas
            ];
            $this->load->view('template_guru/nav', $data);
            $this->load->view('guru/add_materi', $data);
            $this->load->view('template_guru/footer');
        } else {
            $file = null; // Initialize file variable
            $upload_file = $_FILES['file'];

            if ($upload_file && $upload_file['error'] == 0) {
                $config['allowed_types'] = 'mp4|mkv|mov|pdf|doc|docx|zip|rar|jpg|jpeg|png';
                $config['max_size'] = '20480'; // 20MB
                $config['upload_path'] = './assets/materi_file';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('guru/add_materi');
                    return;
                }
            } else {
                $this->session->set_flashdata('error', 'File tidak ditemukan atau terjadi kesalahan upload');
                redirect('guru/add_materi');
                return;
            }

            $data = [
                'nama_guru' => htmlspecialchars($nama_guru, true),
                'nama_mapel' => htmlspecialchars($nama_mapel, true),
                'file' => $file,
                'deskripsi' => htmlspecialchars($deskripsi, true),
                'id_kelas' => htmlspecialchars($id_kelas, true),
                'nip' => $this->user_data['nip'],
                'tanggal_upload' => date('Y-m-d H:i:s')
            ];

            if ($this->db->insert('materi', $data)) {
                $this->session->set_flashdata('success-reg', 'Berhasil menambahkan materi!');
                redirect(base_url('guru/materi'));
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan materi');
                redirect('guru/add_materi');
            }
        }
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './assets/materi_file';
        $config['allowed_types'] = 'mp4|mkv';
        $config['file_name'] = $this->product_id;
        $config['overwrite'] = true;
        $config['max_size'] = 0; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default.mp4";
    }

    public function data_kelas()
    {
        $this->load->model('m_kelas');

        // Use user data fetched in constructor
        $data['user'] = $this->user_data;

        $data['total_kelas'] = $this->m_kelas->get_total_kelas();
        $data['kelas_list'] = $this->m_kelas->get_kelas_with_student_count();
        
        $this->load->view('template_guru/nav');
        $this->load->view('guru/data_kelas', $data);
        $this->load->view('template_guru/footer');
    }

    public function tambah_tugas()
    {
        $guru = (object) $this->user_data;
        $nip = $guru->nip;
        $id_mapel_guru = $guru->id_mapel ?? null;
        $mapel_list = [];

        if (!empty($id_mapel_guru)) {
            $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel_guru])->row_array();
            if ($mapel_data) {
                $mapel_list[] = $mapel_data;
            }
        }

        // Tambahkan pengambilan data kelas
        $this->load->model('m_kelas');
        $data['kelas_list'] = $this->m_kelas->tampil_data()->result();

        $data['mapel'] = $mapel_list;
        $data['user'] = $this->user_data;

        if ($this->input->post()) {
            $judul_tugas = $this->input->post('judul_tugas');
            $id_mapel = $this->input->post('id_mapel');
            $kelas = $this->input->post('kelas');
            $deadline_date = $this->input->post('deadline_date');
            $deadline_time = $this->input->post('deadline_time');
            $deskripsi = $this->input->post('deskripsi');

            // Validasi input
            $this->form_validation->set_rules('judul_tugas', 'Judul Tugas', 'required|trim');
            $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required|trim');
            $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
            $this->form_validation->set_rules('deadline_date', 'Tanggal Deadline', 'required|trim');
            $this->form_validation->set_rules('deadline_time', 'Waktu Deadline', 'required|trim');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template_guru/nav', $data);
                $this->load->view('guru/tambah_tugas', $data);
                $this->load->view('template_guru/footer', $data);
            } else {
                // Gabungkan tanggal dan waktu deadline
                $deadline = date('Y-m-d H:i:s', strtotime($deadline_date . ' ' . $deadline_time));

                // Ambil nama mapel
                $mapel = $this->db->get_where('mapel', ['id_mapel' => $id_mapel])->row();
                $nama_mapel = $mapel ? $mapel->nama_mapel : '';

                // Data untuk disimpan
                $tugas_data = [
                    'judul_tugas' => $judul_tugas,
                    'id_mapel' => $id_mapel,
                    'kelas' => $kelas,
                    'deadline' => $deadline,
                    'deskripsi' => $deskripsi,
                    'nama_mapel' => $nama_mapel
                ];

                // Upload file jika ada
                if (!empty($_FILES['file_tugas']['name'])) {
                    $config['upload_path'] = './uploads/tugas/';
                    $config['allowed_types'] = 'mp4|mkv|mov|pdf|doc|docx|zip|rar|jpg|jpeg|png';
                    $config['max_size'] = 2048; // 2MB
                    $config['encrypt_name'] = TRUE;

                    // Buat direktori jika belum ada
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    }
                    if (!is_writable($config['upload_path'])) {
                        chmod($config['upload_path'], 0777);
                    }

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('file_tugas')) {
                        $upload_data = $this->upload->data();
                        $tugas_data['file_tugas'] = $upload_data['file_name'];
                    } else {
                        $this->session->set_flashdata('error_tugas', $this->upload->display_errors());
                        redirect('guru/tambah_tugas');
                    }
                }

                // Simpan data tugas
                if ($this->db->insert('tugas', $tugas_data)) {
                    $id_tugas = $this->db->insert_id();
                    
                    // Jika ada file yang diupload, langsung kembali ke halaman tugas
                    if (!empty($tugas_data['file_tugas'])) {
                        $this->session->set_flashdata('success', 'Tugas berhasil ditambahkan');
                        redirect('guru/tugas');
                    } else {
                        // Jika tidak ada file, arahkan ke halaman tambah soal PG
                        $this->session->set_flashdata('success', 'Tugas berhasil ditambahkan. Silakan tambahkan soal pilihan ganda.');
                        redirect('guru/tambah_soal_pilihan_ganda?id_tugas=' . $id_tugas);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan tugas');
                    redirect('guru/tambah_tugas');
                }
            }
        } else {
            $this->load->view('template_guru/nav', $data);
            $this->load->view('guru/tambah_tugas', $data);
            $this->load->view('template_guru/footer', $data);
        }
    }

    public function delete_tugas($id_tugas)
    {
        $this->load->model('m_tugas');
        if ($this->m_tugas->delete_tugas($id_tugas)) {
            $this->session->set_flashdata('success_tugas_delete', 'Tugas berhasil dihapus');
        } else {
            $this->session->set_flashdata('error_tugas_delete', 'Gagal menghapus tugas');
        }
        redirect('guru/tugas');
    }

    public function tugas()
    {
        $this->load->model('m_tugas');
        $nip = $this->user_data['nip']; // Get the ID of the logged-in teacher
        
        $tasks_query = $this->m_tugas->tampil_data_by_guru($nip);
        $data['tugas'] = $tasks_query->result();
        
        // Get the count of tasks for the logged-in teacher
        $data['total_tugas'] = $tasks_query->num_rows();

        $this->load->view('template_guru/nav');
        $this->load->view('guru/tugas', $data);
        $this->load->view('template_guru/footer');
    }

    public function detail_tugas($id_tugas)
    {
        $this->load->model('m_tugas');
        $where = array('id_tugas' => $id_tugas);
        $detail = $this->m_tugas->detail_tugas($id_tugas);
        $data['detail'] = $detail;
        
        // Get submissions for this task
        $data['submissions'] = $this->m_tugas->get_submissions_by_tugas($id_tugas);

        $this->load->view('template_guru/nav');
        $this->load->view('guru/detail_tugas', $data);
        $this->load->view('template_guru/footer');
    }

    public function download_tugas($id_tugas)
    {
        $data = $this->db->get_where('tugas',['id_tugas'=>$id_tugas])->row();
        if (!$data || !$data->file_tugas) {
            show_404();
        }

        $file_path = './assets/tugas/' . $data->file_tugas;
        if (!file_exists($file_path)) {
            $this->session->set_flashdata('error', 'File tidak ditemukan');
            redirect('guru/tugas');
            return;
        }

        $this->load->helper('download');
        force_download($file_path, NULL);
    }

    // Function to assign a task to a class
    public function assign_task_to_class()
    {
        // Load necessary models (assuming M_tugas and M_kelas exist)
        $this->load->model('m_tugas');
        $this->load->model('m_kelas');

        // Fetch data for dropdowns (list of tasks and classes)
        $data['tasks'] = $this->m_tugas->get_all_tasks(); // You'll need to create this method in M_tugas
        $data['classes'] = $this->m_kelas->tampil_data()->result();

        // Handle form submission
        if ($this->input->post())
        {
            $task_id = $this->input->post('task_id');
            $id_kelas = $this->input->post('id_kelas');
            $nip = $this->session->userdata('nip'); // Assuming teacher's NIP is in session

            // Prepare data for insertion into a new assignments table
            $assignment_data = array(
                'task_id' => $task_id,
                'id_kelas' => $id_kelas,
                'nip' => $nip,
                'assignment_date' => date('Y-m-d H:i:s') // Or whatever date field you need
                // Add other relevant fields like due date if needed
            );

            // Insert data into a new table (e.g., 'tugas_assignments')
            // You will need to create a model method for this, e.g., $this->m_tugas->assign_task($assignment_data);
            // $this->db->insert('tugas_assignments', $assignment_data);

            // Redirect or show success message
            // redirect('guru/data_tugas'); // Redirect to task list or another page
            // $this->session->set_flashdata('success', 'Task assigned successfully!');
        }

        // Load the view for assigning tasks
        // You will need to create a view like 'guru/assign_task_to_class.php' to display the form
        // $this->load->view('template_guru/nav');
        // $this->load->view('guru/assign_task_to_class', $data);
        // $this->load->view('template_guru/footer');
    }

    // Function to handle grade and comment submission
    public function submit_grade_comment()
    {
        log_message('debug', 'Starting submit_grade_comment function');

        $this->load->model('m_tugas');

        $id_submission = $this->input->post('id_submission');
        $nilai = $this->input->post('nilai');
        $komentar = $this->input->post('komentar');

        log_message('debug', 'Received id_submission: ' . $id_submission);
        log_message('debug', 'Received nilai: ' . $nilai);
        log_message('debug', 'Received komentar: ' . $komentar);

        $data = array(
            'nilai' => $nilai,
            'komentar' => $komentar
        );

        log_message('debug', 'Data to update: ' . print_r($data, TRUE));

        if ($this->m_tugas->update_submission($id_submission, $data)) {
            log_message('debug', 'Submission updated successfully for id_submission: ' . $id_submission);
            $this->session->set_flashdata('success', 'Nilai dan komentar berhasil disimpan.');
        } else {
            log_message('error', 'Failed to update submission for id_submission: ' . $id_submission);
            $this->session->set_flashdata('error', 'Gagal menyimpan nilai dan komentar.');
        }

        // Redirect back to the task detail page
        // Need to get the id_tugas from the submission to redirect correctly
        $submission = $this->db->get_where('submission_tugas', array('id_submission' => $id_submission))->row();
        if ($submission) {
            redirect('guru/detail_tugas/' . $submission->id_tugas);
        } else {
            log_message('error', 'Submission not found for redirection: ' . $id_submission);
            redirect('guru/tugas'); // Redirect to task list if submission not found
        }
    }

    public function materi()
    {
        // Get the logged-in teacher's name
        $nama_guru_loggedin = $this->user_data['nama_guru'];

        // Fetch materials filtered by the logged-in teacher's name
        $this->db->select('materi.*, guru.nip, kelas.nama_kelas');
        $this->db->from('materi');
        $this->db->join('guru', 'guru.nama_guru = materi.nama_guru', 'left');
        $this->db->join('kelas', 'kelas.id_kelas = materi.id_kelas', 'left');
        $this->db->where('materi.nama_guru', $nama_guru_loggedin);
        $data['materi'] = $this->db->get()->result_array();

        // Fetch the total count of materials for the logged-in teacher
        $this->db->where('nama_guru', $nama_guru_loggedin);
        $data['total_materi'] = $this->db->count_all_results('materi');

        $this->load->view('template_guru/nav');
        $this->load->view('guru/materi', $data);
        $this->load->view('template_guru/footer');
    }

    public function edit_materi($id)
    {
        // Use user data fetched in constructor
        $data['user'] = $this->user_data;
            
        $data['materi'] = $this->db->get_where('materi', ['id_materi' => $id])->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();

        // Ensure all form fields have default values if null
        $nama_guru = $this->input->post('nama_guru') ?? '';
        $nama_mapel = $this->input->post('nama_mapel') ?? '';
        $deskripsi = $this->input->post('deskripsi') ?? '';
        $id_kelas = $this->input->post('id_kelas') ?? '';

        // Set validation data
        $validation_data = [
            'nama_guru' => $nama_guru,
            'nama_mapel' => $nama_mapel,
            'deskripsi' => $deskripsi,
            'id_kelas' => $id_kelas
        ];
        $this->form_validation->set_data($validation_data);

        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|trim');
        $this->form_validation->set_rules('nama_mapel', 'Mata Pelajaran', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template_guru/nav');
            $this->load->view('guru/edit_materi', $data);
            $this->load->view('template_guru/footer');
        } else {
            $file = $data['materi']['file']; // Keep existing file by default
            $upload_file = $_FILES['file'];

            if ($upload_file && $upload_file['error'] == 0) {
                $config['allowed_types'] = 'mp4|mkv|mov|pdf|doc|docx|zip|rar|jpg|jpeg|png';
                $config['max_size'] = '20480'; // 20MB
                $config['upload_path'] = './assets/materi_file';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    // Delete old file if exists
                    if ($file && file_exists('./assets/materi_file/' . $file)) {
                        unlink('./assets/materi_file/' . $file);
                    }
                    $file = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('guru/edit_materi/' . $id);
                    return;
                }
            }

            $data = [
                'nama_guru' => htmlspecialchars($this->input->post('nama_guru', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'file' => $file,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
                'kelas' => $this->db->get_where('kelas', ['id_kelas' => $this->input->post('id_kelas', true)])->row()->nama_kelas,
                'nip' => $this->user_data['nip'],
            ];

            $this->db->where('id_materi', $id);
            if ($this->db->update('materi', $data)) {
                $this->session->set_flashdata('success', 'Materi berhasil diperbarui');
                redirect('guru/materi');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui materi');
                redirect('guru/edit_materi/' . $id);
            }
        }
    }

    public function hapus_materi($id)
    {
        // Get file name before deleting record
        $materi = $this->db->get_where('materi', ['id_materi' => $id])->row_array();
        
        if ($materi) {
            // Delete file if exists
            if ($materi['file'] && file_exists('./assets/materi_file/' . $materi['file'])) {
                unlink('./assets/materi_file/' . $materi['file']);
            }
            
            // Delete record from database
            $this->db->where('id_materi', $id);
            if ($this->db->delete('materi')) {
                $this->session->set_flashdata('success', 'Materi berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus materi');
            }
        }
        
        redirect('guru/materi');
    }

    public function edit_tugas($id_tugas)
    {
        // Get logged in teacher's data from constructor
        $guru = (object) $this->user_data;

        // Get the teacher's subject ID from the guru data
        $id_mapel_guru = $guru->id_mapel ?? null;
        $mapel_list = [];

        // If id_mapel is set for the guru, fetch the subject details from the mapel table
        if (!empty($id_mapel_guru)) {
            $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel_guru])->row_array();
            if ($mapel_data) {
                $mapel_list[] = $mapel_data;
            }
        }

        // Load the kelas model and get all classes
        $this->load->model('m_kelas');
        $data['kelas_list'] = $this->m_kelas->tampil_data()->result();

        // Pass the relevant mapel data to the view
        $data['mapel'] = $mapel_list;
        $data['user'] = $this->user_data; // Pass user data to view

        $this->load->model('m_tugas');
        $data['tugas'] = $this->m_tugas->get_tugas_by_id($id_tugas);

        if (!$data['tugas']) {
            show_404(); // Show 404 if task not found
        }

        // Set form data for the view, pre-filling with existing task data
        $data['form_data'] = [
            'judul_tugas' => $data['tugas']->judul_tugas ?? '',
            'id_mapel' => $data['tugas']->id_mapel ?? '',
            'kelas' => $data['tugas']->kelas ?? '',
            'deadline_date' => date('Y-m-d', strtotime($data['tugas']->deadline)) ?? '',
            'deadline_time' => date('H:i', strtotime($data['tugas']->deadline)) ?? '',
            'deskripsi' => $data['tugas']->deskripsi ?? '',
            'file_tugas' => $data['tugas']->file_tugas ?? ''
        ];

        $this->load->view('template_guru/nav');
        $this->load->view('guru/edit_tugas_form', $data); // Need to create this view
        $this->load->view('template_guru/footer');
    }

    public function update_tugas()
    {
        $this->load->model('m_tugas');

        $id_tugas = $this->input->post('id_tugas');

        // Ensure all form fields have default values if null
        $judul_tugas = $this->input->post('judul_tugas', FALSE) ?? '';
        $id_mapel = $this->input->post('id_mapel', FALSE) ?? '';
        $kelas = $this->input->post('kelas', FALSE) ?? '';
        $deadline_date = $this->input->post('deadline_date', FALSE) ?? '';
        $deadline_time = $this->input->post('deadline_time', FALSE) ?? '';
        $deskripsi = $this->input->post('deskripsi', FALSE) ?? '';
        $old_file_tugas = $this->input->post('old_file_tugas', FALSE) ?? '';

        // Set validation data
        $validation_data = [
            'judul_tugas' => $judul_tugas,
            'id_mapel' => $id_mapel,
            'kelas' => $kelas,
            'deadline_date' => $deadline_date,
            'deadline_time' => $deadline_time,
            'deskripsi' => $deskripsi
        ];
        $this->form_validation->set_data($validation_data);

        $this->form_validation->set_rules('judul_tugas', 'Judul Tugas', 'required|trim', [
            'required' => 'Judul Tugas harus diisi.'
        ]);
        $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required|trim', [
            'required' => 'Mata Pelajaran harus diisi.'
        ]);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', [
            'required' => 'Kelas harus diisi.'
        ]);
        $this->form_validation->set_rules('deadline_date', 'Tanggal Deadline', 'required|trim', [
            'required' => 'Tanggal Deadline harus diisi.'
        ]);
        $this->form_validation->set_rules('deadline_time', 'Waktu Deadline', 'required|trim', [
            'required' => 'Waktu Deadline harus diisi.'
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim', [
            'required' => 'Deskripsi harus diisi.'
        ]);

        if ($this->form_validation->run() == false) {
            // If validation fails, reload the edit form with validation errors
            // Pass form data back to the view for persistence
            $data['form_data'] = $validation_data;
            $this->edit_tugas($id_tugas);
        } else {
            // Handle file upload
            $file_tugas = $old_file_tugas; // Keep existing file by default
            if (!empty($_FILES['file_tugas']['name'])) {
                $config['upload_path'] = './uploads/tugas/';
                $config['allowed_types'] = 'mp4|mkv|mov|pdf|doc|docx|zip|rar|jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB
                $config['encrypt_name'] = TRUE;

                // Buat direktori jika belum ada
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }
                if (!is_writable($config['upload_path'])) {
                    chmod($config['upload_path'], 0777);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_tugas')) {
                    // Delete old file if exists
                    if ($file_tugas && file_exists('./uploads/tugas/' . $file_tugas)) {
                        unlink('./uploads/tugas/' . $file_tugas);
                    }
                    $file_tugas = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error_tugas', $this->upload->display_errors('',''));
                    redirect('guru/edit_tugas/' . $id_tugas);
                    return;
                }
            }

            // Combine date and time for deadline
            $deadline_date = $this->input->post('deadline_date', FALSE);
            $deadline_time = $this->input->post('deadline_time', FALSE);
            $deadline = date('Y-m-d H:i:s', strtotime("$deadline_date $deadline_time"));

            // Get nama_mapel from id_mapel
            $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel])->row_array();
            $nama_mapel = $mapel_data['nama_mapel'] ?? '';

            $data = [
                'judul_tugas' => htmlspecialchars($judul_tugas, true),
                'id_mapel' => htmlspecialchars($id_mapel, true),
                'kelas' => $kelas,
                'deadline' => $deadline,
                'deskripsi' => htmlspecialchars($deskripsi, true),
                'file_tugas' => $file_tugas,
                'nama_mapel' => $nama_mapel
            ];

            if ($this->m_tugas->update_tugas($id_tugas, $data)) {
                $this->session->set_flashdata('success_tugas_update', 'Tugas berhasil diperbarui');
                redirect('guru/tugas');
            } else {
                $this->session->set_flashdata('error_tugas_update', 'Gagal memperbarui tugas');
                redirect('guru/edit_tugas/' . $id_tugas);
            }
        }
    }

    // Management Jadwal for Guru

    public function data_jadwal()
    {
        $this->load->model('m_jadwal');

        $data['user'] = $this->user_data;
        $nip = $this->user_data['nip'];

        $data['jadwal'] = $this->db->get_where('jadwal', ['nip' => $nip])->result();
        
        $this->load->view('template_guru/nav');
        $this->load->view('guru/data_jadwal', $data);
        $this->load->view('template_guru/footer');
    }

    public function soal_pilihan_ganda()
    {
        $this->load->helper('text'); // Memuat helper 'text' untuk fungsi character_limiter()
        $nip = $this->user_data['nip'];
        $data['soal'] = $this->M_PilihanGanda->get_all_soal_by_guru($nip);
        $data['user'] = $this->user_data;

        // Ambil id_tugas dari parameter GET jika ada
        $id_tugas_otomatis = $this->input->get('id_tugas');
        if ($id_tugas_otomatis) {
            $data['id_tugas_otomatis'] = $id_tugas_otomatis;
        }

        $this->load->view('template_guru/nav', $data);
        $this->load->view('guru/soal_pilihan_ganda', $data);
        $this->load->view('template_guru/footer', $data);
    }

    public function tambah_soal_pilihan_ganda()
    {
        $guru = (object) $this->user_data;
        $nip = $guru->nip;
        $id_mapel_guru = $guru->id_mapel ?? null;
        $mapel_list = [];

        if (!empty($id_mapel_guru)) {
            $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel_guru])->row_array();
            if ($mapel_data) {
                $mapel_list[] = $mapel_data;
            }
        }

        $this->load->model('m_tugas');
        $data['tugas_list'] = $this->m_tugas->tampil_data_by_guru($nip)->result();

        $data['mapel'] = $mapel_list;
        $data['user'] = $this->user_data;

        // Ambil id_tugas dari parameter GET jika ada
        $id_tugas_otomatis = $this->input->get('id_tugas');
        if ($id_tugas_otomatis) {
            $data['id_tugas_otomatis'] = $id_tugas_otomatis;
        }

        if ($this->input->post()) {
            $id_mapel = $this->input->post('id_mapel');
            $id_tugas = $this->input->post('id_tugas');
            $soal_array = $this->input->post('soal');

            // Validasi input
            $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required');
            if (empty($id_tugas_otomatis)) {
                $this->form_validation->set_rules('id_tugas', 'Tugas', 'required');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('template_guru/nav', $data);
                $this->load->view('guru/tambah_soal_pilihan_ganda', $data);
                $this->load->view('template_guru/footer', $data);
            } else {
                $success = true;
                $this->db->trans_start();

                foreach ($soal_array as $soal) {
                    // Validasi setiap soal
                    if (empty($soal['pertanyaan']) || empty($soal['pilihan_a']) || 
                        empty($soal['pilihan_b']) || empty($soal['pilihan_c']) || 
                        empty($soal['pilihan_d']) || empty($soal['kunci_jawaban'])) {
                        $success = false;
                        break;
                    }

                    // Data untuk tabel soal_pilihan_ganda
                    $soal_data = [
                        'pertanyaan' => $soal['pertanyaan'],
                        'id_mapel' => $id_mapel,
                        'id_tugas' => $id_tugas,
                        'nip' => $nip,
                        'kunci_jawaban' => $soal['kunci_jawaban'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    // Insert ke tabel soal_pilihan_ganda
                    $this->db->insert('soal_pilihan_ganda', $soal_data);
                    $id_soal = $this->db->insert_id();

                    // Data untuk tabel pilihan_jawaban
                    $pilihan_data = [
                        'id_soal' => $id_soal,
                        'pilihan_a' => $soal['pilihan_a'],
                        'pilihan_b' => $soal['pilihan_b'],
                        'pilihan_c' => $soal['pilihan_c'],
                        'pilihan_d' => $soal['pilihan_d']
                    ];

                    // Insert ke tabel pilihan_jawaban
                    $this->db->insert('pilihan_jawaban', $pilihan_data);
                }

                $this->db->trans_complete();

                if ($success && $this->db->trans_status() === TRUE) {
                    $this->session->set_flashdata('success_soal', 'Soal pilihan ganda berhasil ditambahkan');
                    redirect('guru/soal_pilihan_ganda');
                } else {
                    $this->session->set_flashdata('error_soal', 'Gagal menambahkan soal pilihan ganda');
                    $this->load->view('template_guru/nav', $data);
                    $this->load->view('guru/tambah_soal_pilihan_ganda', $data);
                    $this->load->view('template_guru/footer', $data);
                }
            }
        } else {
            $this->load->view('template_guru/nav', $data);
            $this->load->view('guru/tambah_soal_pilihan_ganda', $data);
            $this->load->view('template_guru/footer', $data);
        }
    }

    public function edit_soal_pilihan_ganda($id_soal)
    {
        // Debugging: Log POST data when the form is submitted
        log_message('error', '[Guru Controller] POST data for edit_soal_pilihan_ganda: ' . print_r($this->input->post(), TRUE));
        // Debugging: Log the fetched soal data
        log_message('error', '[Guru Controller] Fetched soal data for id ' . $id_soal . ': ' . print_r($this->M_PilihanGanda->get_soal_by_id($id_soal), TRUE));

        $data['user'] = $this->user_data;
        $data['soal'] = $this->M_PilihanGanda->get_soal_by_id($id_soal);

        if (!$data['soal']) {
            $this->session->set_flashdata('error_soal', 'Soal tidak ditemukan.');
            redirect('guru/soal_pilihan_ganda');
        }

        $guru = (object) $this->user_data;
        $nip = $guru->nip; // Get the nip of the logged-in teacher
        $id_mapel_guru = $guru->id_mapel ?? null;
        $mapel_list = [];

        if (!empty($id_mapel_guru)) {
            $mapel_data = $this->db->get_where('mapel', ['id_mapel' => $id_mapel_guru])->row_array();
            if ($mapel_data) {
                $mapel_list[] = $mapel_data;
            }
        }
        $this->load->model('m_tugas');
        $data['tugas_list'] = $this->m_tugas->tampil_data_by_guru($nip)->result();

        $data['mapel'] = $mapel_list;

        $pertanyaan = $this->input->post('pertanyaan', FALSE) ?? ($data['soal']->pertanyaan ?? '');
        $pilihan_a = $this->input->post('pilihan_a', FALSE) ?? ($data['soal']->pilihan_a ?? '');
        $pilihan_b = $this->input->post('pilihan_b', FALSE) ?? ($data['soal']->pilihan_b ?? '');
        $pilihan_c = $this->input->post('pilihan_c', FALSE) ?? ($data['soal']->pilihan_c ?? '');
        $pilihan_d = $this->input->post('pilihan_d', FALSE) ?? ($data['soal']->pilihan_d ?? '');
        $kunci_jawaban = $this->input->post('kunci_jawaban', FALSE) ?? ($data['soal']->kunci_jawaban ?? '');
        $id_mapel = $this->input->post('id_mapel', FALSE) ?? ($data['soal']->id_mapel ?? '');
        $id_tugas = $this->input->post('id_tugas', FALSE) ?? ($data['soal']->id_tugas ?? ''); // Changed ?? null to ?? ''

        $validation_data = [
            'pertanyaan' => $pertanyaan,
            'pilihan_a' => $pilihan_a,
            'pilihan_b' => $pilihan_b,
            'pilihan_c' => $pilihan_c,
            'pilihan_d' => $pilihan_d,
            'kunci_jawaban' => $kunci_jawaban,
            'id_mapel' => $id_mapel,
            'id_tugas' => $id_tugas // Add id_tugas to validation data
        ];
        $this->form_validation->set_data($validation_data);

        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required|trim', [
            'required' => 'Pertanyaan harus diisi.'
        ]);
        $this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'required|trim', [
            'required' => 'Pilihan A harus diisi.'
        ]);
        $this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'required|trim', [
            'required' => 'Pilihan B harus diisi.'
        ]);
        $this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'required|trim', [
            'required' => 'Pilihan C harus diisi.'
        ]);
        $this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'required|trim', [
            'required' => 'Pilihan D harus diisi.'
        ]);
        $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required|trim|in_list[A,B,C,D]', [
            'required' => 'Kunci Jawaban harus diisi.',
            'in_list' => 'Kunci Jawaban harus A, B, C, atau D.'
        ]);
        $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required|trim', [
            'required' => 'Mata Pelajaran harus diisi.'
        ]);
        $this->form_validation->set_rules('id_tugas', 'Tugas', 'trim|numeric'); // Allow empty, validate as numeric if not empty

        if ($this->form_validation->run() == false) {
            $data['form_data'] = $validation_data;
            $this->load->view('template_guru/nav', $data);
            $this->load->view('guru/edit_soal_pilihan_ganda', $data);
            $this->load->view('template_guru/footer', $data);
        } else {
            $soal_data = [
                'id_mapel' => htmlspecialchars($id_mapel, true),
                'pertanyaan' => htmlspecialchars($pertanyaan, true),
                'kunci_jawaban' => htmlspecialchars($kunci_jawaban, true),
                'id_tugas' => $id_tugas === '' ? null : htmlspecialchars($id_tugas, true) // Store as NULL if empty
            ];

            $pilihan_data = [
                'pilihan_a' => htmlspecialchars($pilihan_a, true),
                'pilihan_b' => htmlspecialchars($pilihan_b, true),
                'pilihan_c' => htmlspecialchars($pilihan_c, true),
                'pilihan_d' => htmlspecialchars($pilihan_d, true)
            ];

            if ($this->M_PilihanGanda->update_soal_pilihan_ganda($id_soal, $soal_data, $pilihan_data)) {
                $this->session->set_flashdata('success_soal_update', 'Soal Pilihan Ganda berhasil diperbarui!');
                redirect('guru/soal_pilihan_ganda');
            } else {
                $this->session->set_flashdata('error_soal_update', 'Gagal memperbarui Soal Pilihan Ganda.');
                redirect('guru/edit_soal_pilihan_ganda/' . $id_soal);
            }
        }
    }

    public function delete_soal_pilihan_ganda($id_soal)
    {
        if ($this->M_PilihanGanda->delete_soal_pilihan_ganda($id_soal)) {
            $this->session->set_flashdata('success_soal_delete', 'Soal Pilihan Ganda berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error_soal_delete', 'Gagal menghapus Soal Pilihan Ganda.');
        }
        redirect('guru/soal_pilihan_ganda');
    }

    // Fungsi sementara untuk memperbaiki created_at yang null atau kosong di soal_pilihan_ganda
    public function fix_soal_created_at()
    {
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->where('created_at IS NULL');
        $this->db->or_where('created_at', '');
        $this->db->update('soal_pilihan_ganda');

        echo "Data created_at di tabel soal_pilihan_ganda telah diperbarui. Silakan refresh halaman soal.";
    }

}
