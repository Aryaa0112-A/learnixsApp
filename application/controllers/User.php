<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_materi');
        $this->load->model('M_tugas');
        $this->load->model('M_diskusi');
        $this->load->model('M_jadwal');
        $this->load->library('email');
        
        // Check if user is logged in
        if (!$this->session->userdata('email')) {
            redirect('welcome'); // Redirect to login if not logged in
            exit; // Ensure script stops after redirect
        }

        // Check user role based on email
        $email = $this->session->userdata('email');
        
        // Check if it's a Guru
        $this->load->model('M_guru');
        $guru_data = $this->M_guru->getByEmail($email)->row_array();
        if ($guru_data) {
            redirect('guru'); // Redirect to guru dashboard
            exit; // Ensure script stops after redirect
        }

        // Check if it's an Admin
        $admin_data = $this->db->get_where('admin', ['email' => $email])->row_array();
        if ($admin_data) {
            redirect('admin'); // Redirect to admin dashboard
            exit; // Ensure script stops after redirect
        }

        // If not a Guru or Admin, assume it's a Siswa and proceed.
        // The following lines were commented out and are now necessary again, so uncomment them.
        // $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('email')) {
        //     redirect('welcome');
        // } - This logic is now covered by the first check.
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $kelas_id = $data['user']['id_kelas'] ?? null;

        $data['jadwal'] = [];
        if ($kelas_id) {
            $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($kelas_id);
            $data['materi'] = $this->M_materi->get_materi_by_kelas($kelas_id);
        }

        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function kelas10()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas10');
        $this->load->view('template/footer');
    }

    public function kelas11()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas11');
        $this->load->view('template/footer');
    }

    public function kelas12()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('user/kelas12');
        $this->load->view('template/footer');
    }

    public function tugas()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array() ?? [];
        $id_kelas = $data['user']['id_kelas'] ?? null;

        // Ambil nama kelas dari tabel kelas
        $kelas_data = null;
        $nama_kelas = '';
        if ($id_kelas) {
            $kelas_data = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row();
            $nama_kelas = $kelas_data ? $kelas_data->nama_kelas : '';
        }

        // Query tugas + jumlah soal PG berdasarkan nama kelas
        $tugas = [];
        if ($nama_kelas) {
            $this->db->select('tugas.*, (SELECT COUNT(*) FROM soal_pilihan_ganda WHERE soal_pilihan_ganda.id_tugas = tugas.id_tugas) as jumlah_soal');
            $this->db->from('tugas');
            $this->db->where('kelas', $nama_kelas);
            $tugas = $this->db->get()->result();

            // Tambahkan status untuk setiap tugas
            foreach ($tugas as &$t) {
                $pengumpulan = $this->db->get_where('submission_tugas', [
                    'id_tugas' => $t->id_tugas,
                    'id_siswa' => $data['user']['id_siswa'] ?? 0
                ])->row();

                if ($pengumpulan) {
                    $t->status = 'sudah';
                    $t->nilai = $pengumpulan->nilai;
                } else {
                    if (strtotime($t->deadline) < time()) {
                        $t->status = 'terlambat';
                    } else {
                        $t->status = 'belum';
                    }
                }
            }
        }
        $data['tugas'] = $tugas ?? [];

        $this->load->view('user/tugas', $data);
        $this->load->view('template/footer');
    }

    public function jadwal()
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        // Get the student's class ID
        $kelas_id = $data['user']['id_kelas'] ?? null;

        // Fetch the schedule for the student's class if class_id is available
        $data['jadwal'] = [];
        if ($kelas_id) {
            $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($kelas_id);
        }

        $this->load->view('user/jadwal', $data);
        $this->load->view('template/footer');
    }

    public function registration()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function registration_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom username.',
            'min_length' => 'Nama terlalu pendek.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[siswa.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/nav');
            $this->load->view('user/registration');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'date_created' => date(),
            ];

            //siapkan token

            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time(),
            // ];

            $this->db->insert('siswa', $data);
            // $this->db->insert('token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('welcome'));
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ini email disini',
            'smtp_pass' => 'Isi Password gmail disini',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $data = array(
            'name' => 'syauqi',
            'link' => ' ' . base_url() . 'welcome/verify?email=' . $this->input->post('email') . '& token' . urlencode($token) . '"',
        );

        $this->email->from('LearnifyEducations@gmail.com', 'Learnify');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $link =
            $this->email->subject('Verifikasi Akun');
            $body = $this->load->view('template/email-template.php', $data, true);
            $this->email->message($body);
        } else {
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }

    public function print_siswa(){
        $this->load->model('m_siswa');
        $data['user'] = $this->m_siswa->tampil_data("siswa")->result();
        $this->load->view('admin/print', $data);
        // $this->mypdf->generate('admin/print', $data, 'laporan-mahasiswa', 'A4', 'landscape');
        
    }

    public function export_excel()
{
    $this->load->model('m_siswa');
    $data['user'] = $this->m_siswa->tampil_data("siswa")->result();

    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $object = new PHPExcel();

    $object->getProperties()->setCreator("Vera Kristina");
    $object->getProperties()->setLastModifiedBy("Data Siswa");
    $object->getProperties()->setTitle("Data Siswa");

    $object->setActiveSheetIndex(0);
    $object->getActiveSheet()->setCellValue('A1', 'NIS');
    $object->getActiveSheet()->setCellValue('B1', 'Nama Lengkap');
    $object->getActiveSheet()->setCellValue('C1', 'Email');
    $object->getActiveSheet()->setCellValue('D1', 'Gambar');

    $baris = 2;
    foreach ($data['user'] as $u) {
        $object->getActiveSheet()->setCellValue('A' . $baris, $u->id_siswa);
        $object->getActiveSheet()->setCellValue('B' . $baris, $u->nama);
        $object->getActiveSheet()->setCellValue('C' . $baris, $u->email);
        $object->getActiveSheet()->setCellValue('D' . $baris, $u->gambar);
        $baris++;
    }

    $filename = "Data Siswa.xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
    $writer->save('php://output');
    exit;
}

    public function detail_tugas($id_tugas)
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();

        // Load tugas model
        $this->load->model('m_tugas');
        
        // Get task details
        $data['tugas'] = $this->m_tugas->get_tugas_by_id($id_tugas);
        if (!$data['tugas']) {
            show_404();
        }
        
        // Get submission status
        $data['submission'] = $this->m_tugas->get_status_tugas($id_tugas, $data['user']['id_siswa']);
        log_message('debug', 'Submission data for student task detail: ' . print_r($data['submission'], TRUE));

        $this->load->view('template/nav');
        $this->load->view('user/detail_tugas', $data);
        $this->load->view('template/footer');
    }

    public function submit_tugas($id_tugas)
    {
        // Retrieve user data from session. 
        // NOTE: This controller is for Siswa, so we explicitly look for Siswa data.
        $user_email = $this->session->userdata('email');
        log_message('debug', 'User email from session: ' . ($user_email ? $user_email : 'NULL'));

        $user_data_siswa = $this->db->get_where('siswa', ['email' => $user_email])->row_array();
        log_message('debug', 'Raw student data from DB: ' . print_r($user_data_siswa, TRUE));

        // If no student data is found, it means the logged-in user is not a student
        // (or session is corrupted). Redirect them away from this student-only page.
        if (empty($user_data_siswa) || !isset($user_data_siswa['id_siswa'])) {
            log_message('error', 'Attempt to access submit_tugas by non-student or invalid session. User data empty or ID not set.');
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini. Silakan login sebagai Siswa.');
            redirect('welcome'); // Redirect to login page
            return; // Stop further execution
        }

        $data['user'] = $user_data_siswa; // Now $data['user'] is guaranteed to be a valid student array
        log_message('debug', 'Student data assigned to $data[\'user\']: ' . print_r($data['user'], TRUE));

        // Load tugas model
        $this->load->model('m_tugas');
        
        // Get task details
        $data['tugas'] = $this->m_tugas->get_tugas_by_id($id_tugas);
        if (!$data['tugas']) {
            log_message('error', 'Task with ID ' . $id_tugas . ' not found.');
            show_404();
            exit; // Ensure script stops after show_404
        }
        log_message('debug', 'Task details: ' . print_r($data['tugas'], TRUE));

        // Check if task is already submitted
        $submission = $this->m_tugas->get_status_tugas($id_tugas, $data['user']['id_siswa']);
        log_message('debug', 'Submission status: ' . print_r($submission, TRUE));

        if ($submission) {
            log_message('info', 'Task ' . $id_tugas . ' already submitted by student ' . $data['user']['id_siswa']);
            $this->session->set_flashdata('error', 'Anda sudah mengumpulkan tugas ini');
            redirect('user/detail_tugas/' . $id_tugas);
            return; // Stop further execution
        }

        // Check if task is past deadline
        if (strtotime($data['tugas']->deadline) < time()) {
            $this->session->set_flashdata('error', 'Tugas sudah melewati batas waktu');
            redirect('user/detail_tugas/' . $id_tugas);
            return; // Stop further execution
        }

        $this->load->view('template/nav');
        $this->load->view('user/submit_tugas', $data);
        $this->load->view('template/footer');
    }

    public function process_submit()
    {
        log_message('debug', 'Starting process_submit function');
        
        $id_tugas = $this->input->post('id_tugas');
        log_message('debug', 'Task ID: ' . $id_tugas);
        
        // Get student data
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();
        $id_siswa = $data['user']['id_siswa'];
        log_message('debug', 'Student ID: ' . $id_siswa);
        
        // Upload file
        $config['upload_path'] = FCPATH . 'uploads/tugas/';
        $config['allowed_types'] = 'mp4|mkv|mov|pdf|doc|docx|zip|rar|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'tugas_' . $id_tugas . '_' . $id_siswa . '_' . time();
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = FALSE;

        // Create the upload directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            log_message('debug', 'Creating upload directory: ' . $config['upload_path']);
            mkdir($config['upload_path'], 0777, TRUE);
        }

        // Ensure directory is writable
        if (!is_writable($config['upload_path'])) {
            log_message('debug', 'Making upload directory writable: ' . $config['upload_path']);
            chmod($config['upload_path'], 0777);
        }

        $this->load->library('upload', $config);
        log_message('debug', 'Upload configuration: ' . print_r($config, true));

        if (!$this->upload->do_upload('file_tugas')) {
            log_message('error', 'Upload error: ' . $this->upload->display_errors());
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('user/submit_tugas/' . $id_tugas);
            return;
        }

        $upload_data = $this->upload->data();
        log_message('debug', 'Upload successful. File data: ' . print_r($upload_data, true));
        
        // Prepare submission data
        $data = array(
            'id_tugas' => $id_tugas,
            'id_siswa' => $id_siswa,
            'file_submission' => $upload_data['file_name'],
            'tanggal_submit' => date('Y-m-d H:i:s'),
            'status' => 'sudah'
        );
        log_message('debug', 'Submission data: ' . print_r($data, true));

        // Save submission
        $this->load->model('m_tugas');
        if ($this->m_tugas->submit_tugas($data)) {
            log_message('debug', 'Submission saved successfully');
            $this->session->set_flashdata('success', 'Tugas berhasil dikumpulkan');
        } else {
            log_message('error', 'Failed to save submission');
            $this->session->set_flashdata('error', 'Gagal mengumpulkan tugas');
        }

        redirect('user/detail_tugas/' . $id_tugas);
    }

    public function kerjakan_quiz($id_tugas)
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();
        $id_siswa = $data['user']['id_siswa'];

        $this->load->model('M_tugas');
        $this->load->model('M_PilihanGanda');

        $tugas = $this->M_tugas->get_tugas_by_id($id_tugas);

        if (!$tugas) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan.');
            redirect('user/tugas');
        }

        // Check if deadline has passed
        if (strtotime($tugas->deadline) < time()) {
            $this->session->set_flashdata('error', 'Waktu pengerjaan tugas ini sudah berakhir.');
            redirect('user/tugas');
        }

        // Check if student has already submitted this quiz
        $submission_status = $this->M_tugas->get_status_tugas($id_tugas, $id_siswa);
        if ($submission_status && $submission_status->status == 'sudah') {
            $this->session->set_flashdata('info', 'Anda sudah mengerjakan quiz ini.');
            redirect('user/tugas');
        }

        $soal_quiz = $this->M_PilihanGanda->get_soal_by_tugas($id_tugas); // This method will be created/modified in M_PilihanGanda

        if (empty($soal_quiz)) {
            $this->session->set_flashdata('error', 'Tidak ada soal pilihan ganda untuk tugas ini.');
            redirect('user/tugas');
        }

        $data['tugas'] = $tugas;
        $data['soal_quiz'] = $soal_quiz;

        $this->load->view('user/kerjakan_quiz', $data);
    }

    public function kerjakan_tugas($id_tugas)
    {
        $data['user'] = $this->db->get_where('siswa', ['email' =>
            $this->session->userdata('email')])->row_array();
        $id_siswa = $data['user']['id_siswa'];

        $this->load->model('M_tugas');

        $tugas = $this->M_tugas->get_tugas_by_id($id_tugas);

        if (!$tugas) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan.');
            redirect('user/tugas');
        }

        // Check if deadline has passed
        if (strtotime($tugas->deadline) < time()) {
            $this->session->set_flashdata('error', 'Waktu pengerjaan tugas ini sudah berakhir.');
            redirect('user/tugas');
        }

        // Check if student has already submitted this task
        $submission_status = $this->M_tugas->get_status_tugas($id_tugas, $id_siswa);
        if ($submission_status && $submission_status->status == 'sudah') {
            $this->session->set_flashdata('info', 'Anda sudah mengumpulkan tugas ini.');
            redirect('user/tugas');
        }

        $data['tugas'] = $tugas;

        $this->load->view('user/submit_tugas', $data);
    }

    public function download($id_tugas)
    {
        $this->load->model('m_tugas');
        $tugas = $this->m_tugas->get_tugas_by_id($id_tugas);
        
        if (!$tugas || !$tugas->file_tugas) {
            show_404();
        }

        $file_path = './uploads/tugas/' . $tugas->file_tugas;
        if (!file_exists($file_path)) {
            show_404();
        }

        $this->load->helper('download');
        force_download($file_path, NULL);
    }

    public function submit_quiz_answers($id_tugas)
    {
        $user = $this->db->get_where('siswa', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('m_tugas');
        $this->load->model('M_PilihanGanda');

        // Cek apakah tugas ada
        $tugas = $this->m_tugas->get_tugas_by_id($id_tugas);
        if (!$tugas) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan');
            redirect('user/tugas');
        }

        // Cek deadline
        $deadline = strtotime($tugas->deadline);
        if (time() > $deadline) {
            $this->session->set_flashdata('error', 'Waktu pengerjaan tugas telah berakhir');
            redirect('user/tugas');
        }

        // Cek apakah sudah mengumpulkan
        $submission_status = $this->m_tugas->get_status_tugas($id_tugas, $user['id_siswa']);
        if ($submission_status && $submission_status->status == 'sudah') {
            $this->session->set_flashdata('info', 'Anda sudah mengumpulkan tugas ini');
            redirect('user/tugas');
        }

        // Ambil semua soal untuk quiz ini
        $soal_quiz = $this->M_PilihanGanda->get_soal_by_tugas($id_tugas);
        if (empty($soal_quiz)) {
            $this->session->set_flashdata('error', 'Tidak ada soal untuk quiz ini');
            redirect('user/tugas');
        }

        // Hitung jumlah soal
        $total_soal = count($soal_quiz);
        $benar = 0;

        // Proses jawaban
        foreach ($soal_quiz as $soal) {
            $jawaban = $this->input->post('jawaban_' . $soal->id_soal);
            if ($jawaban == $soal->kunci_jawaban) {
                $benar++;
            }
        }

        // Hitung nilai
        $nilai = ($benar / $total_soal) * 100;

        // Simpan pengumpulan
        $data_pengumpulan = [
            'id_tugas' => $id_tugas,
            'id_siswa' => $user['id_siswa'],
            'status' => 'sudah',
            'nilai' => $nilai,
            'tanggal_submit' => date('Y-m-d H:i:s')
        ];

        if ($this->m_tugas->submit_tugas($data_pengumpulan)) {
            $this->session->set_flashdata('success', 'Jawaban quiz berhasil dikirim. Nilai Anda: ' . number_format($nilai, 2));
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim jawaban quiz.');
        }

        redirect('user/tugas');
    }
}