<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'tanggal']);
        $this->load->model('m_jadwal');
        if (!$this->session->userdata('email')) {
            redirect('welcome/admin');
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $this->load->view('admin/index', $data);
    }

    public function registration()
    {
        //kita butuhkan untuk validasi input
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
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Harap pilih Kelas.',
        ]);

        // Load the M_kelas model to get the list of classes
        $this->load->model('M_kelas');
        $data['kelas_list'] = $this->M_kelas->tampil_data()->result();

        if ($this->form_validation->run() == false) {
        $this->load->view('template_admin/nav');
            $this->load->view('admin/registration', $data); // Pass kelas_list to the view
        $this->load->view('template_admin/footer');
        } else {
            $email = $this->input->post('email', true);
            $id_kelas = htmlspecialchars($this->input->post('id_kelas', true)); // Get the selected id_kelas

            // Get the nama_kelas based on the id_kelas
            $kelas_data = $this->M_kelas->detail_kelas($id_kelas);
            $nama_kelas = $kelas_data ? $kelas_data->nama_kelas : null;

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'date_created' => format_indo(date('Y-m-d')),
                'id_kelas' => $id_kelas, // Use the retrieved id_kelas
                'nama_kelas' => $nama_kelas, // Add nama_kelas
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
            redirect(base_url('admin/data_siswa'));
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

    // Management Siswa

    public function data_siswa()
    {
        $this->load->model('m_siswa');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_siswa', $data);
        $this->load->view('template_admin/footer');
    }

    public function detail_siswa($id_siswa)
    {
        $this->load->model('m_siswa');
        $where = array('id_siswa' => $id_siswa);
        $detail = $this->m_siswa->detail_siswa($id_siswa);
        $data['detail'] = $detail;
        $this->load->view('template_deted/nav');
        $this->load->view('admin/detail_siswa', $data);
        $this->load->view('template_deted/footer');
    }

    public function update_siswa($id_siswa)
    {
        $this->load->model('m_siswa');
        $where = array('id_siswa' => $id_siswa);
        $data['user'] = $this->m_siswa->update_siswa($where, 'siswa')->result();
        $this->load->view('template_deted/nav');
        $this->load->view('admin/update_siswa', $data);
        $this->load->view('template_deted/footer');
    }

    public function user_edit()
    {
        $this->load->model('m_siswa');

        $id_siswa = $this->input->post('id_siswa');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $id_kelas = htmlspecialchars($this->input->post('id_kelas', true)); // Get the selected id_kelas
        $gambar = $_FILES['image']['name'];

        $data = array(
            'nama' => $nama,
            'email' => $email,
            'id_kelas' => $id_kelas,
        );

        // Get the nama_kelas based on the id_kelas and add it to the data array
        $this->load->model('M_kelas');
        $kelas_data = $this->M_kelas->detail_kelas($id_kelas);
        if ($kelas_data) {
            $data['nama_kelas'] = $kelas_data->nama_kelas;
        }

        $config['allowed_types'] = 'jpg|png|gif|jfif';
        $config['max_size'] = '4096';
        $config['upload_path'] = './assets/profile_picture';

        $this->load->library('upload', $config);
        //berhasil
        if ($this->upload->do_upload('image')) {
            $gambarLama = $data['user']['image'];
            if ($gambarLama != 'default.jpg') {
                unlink(FCPATH . '/assets/profile_picture/' . $gambarLama);
            }
            $gambarBaru = $this->upload->data('file_name');
            $this->db->set('image', $gambarBaru);
        } else {
            echo $this->upload->display_errors();
        }

        $where = array(
            'id_siswa' => $id_siswa,
        );

        $this->m_siswa->update_data($where, $data, 'siswa');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_siswa');
    }

    public function delete_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('id' => $id);
        $this->m_siswa->delete_siswa($where, 'siswa');
        $this->session->set_flashdata('success-delete', 'berhasil');
        redirect('admin/data_siswa');
    }

    // manajemen guru

    public function data_guru()
    {
        $this->load->model('m_guru');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_guru->tampil_data()->result();
        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_guru', $data);
        $this->load->view('template_admin/footer');
    }

    public function detail_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $detail = $this->m_guru->detail_guru($nip);
        $data['detail'] = $detail;
        $this->load->view('template_deted/nav');
        $this->load->view('admin/detail_guru', $data);
        $this->load->view('template_deted/footer');

    }

    public function update_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $data['user'] = $this->m_guru->update_guru($where, 'guru')->result();
        $this->load->view('template_deted/nav');
        $this->load->view('admin/update_guru', $data);
        $this->load->view('template_deted/footer');
    }

    public function guru_edit()
    {
        $this->load->model('m_guru');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $data = array(
            'nip' => $nip,
            'nama_guru' => $nama,
            'email' => $email,

        );

        $where = array(
            'nip' => $nip,
        );

        $this->m_guru->update_data($where, $data, 'guru');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_guru');
    }

    public function delete_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $this->m_guru->delete_guru($where, 'guru');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_guru');
    }

    public function add_guru()
    {
        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom NIP.',
            'min_length' => 'NIP terlalu pendek.',
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[guru.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom nAMA.',
            'min_length' => 'Nama terlalu pendek.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
        $this->load->view('template_admin/nav');
            $this->load->view('guru/registration');
        $this->load->view('template_admin/footer');
        } else {
            $data = [
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_mapel' => htmlspecialchars($this->input->post('mapel', true)),
            ];

            $this->db->insert('guru', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_guru'));
        }
    }    

    //manajemen materi

    public function data_materi()
    {
        $this->load->model('m_materi');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['user'] = $this->m_materi->tampil_data()->result();
        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_materi', $data);
        $this->load->view('template_admin/footer');
    }

    public function delete_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('id_materi' => $id);
        $this->m_materi->delete_materi($where, 'materi');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_materi');
    }

    public function tambah_materi()
    {
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
        $this->load->view('template_admin/nav');
            $this->load->view('admin/add_materi');
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
                    redirect('admin/tambah_materi');
                    return;
                }
            } else {
                $this->session->set_flashdata('error', 'File tidak ditemukan atau terjadi kesalahan upload');
                redirect('admin/tambah_materi');
                return;
            }

            $nama_guru = htmlspecialchars($this->input->post('nama_guru', true));
            $guru_data = $this->db->get_where('guru', ['nama_guru' => $nama_guru])->row_array();
            $nip = $guru_data['nip'] ?? null; 

            $data = [
                'nama_guru' => $nama_guru,
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'nip' => $nip,
                'file' => $file,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
                'tanggal_upload' => date('Y-m-d H:i:s')
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_materi'));
        }
    }

    public function update_materi($id)
    {
        $this->load->model('m_materi');
        $where = array('id_materi' => $id);
        $data['user'] = $this->m_materi->update_materi($where, 'materi')->result();
        $this->load->view('template_admin/nav');
        $this->load->view('admin/update_materi', $data);
        $this->load->view('template_admin/footer');
    }

    public function materi_edit()
    {
        $this->load->model('m_materi');

        $id = htmlspecialchars($this->input->post('id', true));
        $nama_guru = htmlspecialchars($this->input->post('nama_guru', true));
        $nama_mapel = htmlspecialchars($this->input->post('nama_mapel', true));
        $deskripsi = htmlspecialchars($this->input->post('deskripsi', true));

        $data = array(
            'nama_guru' => $nama_guru,
            'nama_mapel' => $nama_mapel,
            'deskripsi' => $deskripsi,
        );

        $where = array(
            'id_materi' => $id,
        );

        $this->m_materi->update_data($where, $data, 'materi');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_materi');
    }

    // manajemen kelas

    public function data_kelas()
    {
        $this->load->model('M_kelas');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();
        $data['kelas_list'] = $this->M_kelas->get_kelas_with_student_count();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_kelas', $data);
        $this->load->view('template_admin/footer');
    }

    public function detail_kelas_admin($id_kelas)
    {
        $this->load->model('M_kelas');
        $this->load->model('M_jadwal');
        $this->load->model('M_siswa');
        
        $data['user'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->M_kelas->detail_kelas($id_kelas);
        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($id_kelas);
        $data['siswa_list'] = $this->M_siswa->get_siswa_by_kelas($id_kelas);
        
        $this->load->view('template_admin/nav', $data);
        $this->load->view('guru/detail_kelas', $data); // Menggunakan view yang sama dengan guru
        $this->load->view('template_admin/footer');
    }

    public function jadwal_kelas_admin($id_kelas)
    {
        $this->load->model('M_kelas');
        $this->load->model('M_jadwal');
        
        $data['user'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['kelas'] = $this->M_kelas->detail_kelas($id_kelas);
        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_kelas($id_kelas);
        
        $this->load->view('template_admin/nav', $data);
        $this->load->view('guru/jadwal_kelas', $data); // Menggunakan view yang sama dengan guru
        $this->load->view('template_admin/footer');
    }

    public function add_kelas()
    {
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom Kelas.',
            'min_length' => 'Kelas terlalu pendek.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template_admin/nav');
            $this->load->view('admin/tambah_kelas');
            $this->load->view('template_admin/footer');
        } else {
            $data = [
                'nama_kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('kelas', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_kelas'));
        }
    }

    public function update_kelas($id)
    {
        $this->load->model('m_kelas');
        $where = array('id_kelas' => $id);
        $data['kelas_data'] = $this->m_kelas->update_kelas($where, 'kelas')->row();
        $this->load->view('template_deted/nav');
        $this->load->view('admin/update_kelas', $data);
        $this->load->view('template_deted/footer');
    }

    public function kelas_edit()
    {
        $this->load->model('m_kelas');
        $id = $this->input->post('id_kelas');
        $kelas = $this->input->post('kelas');

        $data = array(
            'nama_kelas' => $kelas,
        );

        $where = array(
            'id_kelas' => $id,
        );

        $this->m_kelas->update_data($where, $data, 'kelas');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_kelas');
    }

    public function delete_kelas($id)
    {
        $this->load->model('m_kelas');
        $where = array('id_kelas' => $id);
        $this->m_kelas->delete_kelas($where, 'kelas');
        $this->session->set_flashdata('success-delete', 'berhasil');
        redirect('admin/data_kelas');
    }

    public function update_bimbel($id_bimbel)
    {
        $this->load->model('m_bimbel');
        $where = array('id_bimbel' => $id_bimbel);
        $data['user'] = $this->m_bimbel->update_bimbel($where, 'bimbel')->result();
            $this->load->view('admin/update_bimbel');
    }

    public function bimbel_edit()
    {
        $this->load->model('m_bimbel');

        $id_bimbel = $this->input->post('id_bimbel');
        $nama_guru = $this->input->post('nama_guru');
        $nama_mapel = $this->input->post('nama_mapel');
        $deskripsi = $this->input->post('deskripsi');

        $data = array(
            'nama_guru' => $nama_guru,
            'nama_mapel' => $nama_mapel,
            'deskripsi' => $deskripsi,

        );

        $where = array(
            'id_bimbel' => $id_bimbel,
        );

        $this->m_bimbel->update_data($where, $data, 'bimbel');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('guru/data_bimbel');
    }

        public function pencarian(){
        $nama_mapel=$this->input->get('nama_mapel');
        $data['hasil'] = $this->m_bimbel->pencarian_d($nama_mapel)->result_array();
        $this->load->view("guru/data_bimbel",$data); // ini view menampilkan hasil pencarian
        }

    // Manajemen Mata Pelajaran

    public function data_mapel()
    {
        $this->load->model('m_mapel'); // Assuming you have an M_mapel model

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        // Get all subjects using the model
        $data['mapel_list'] = $this->m_mapel->tampil_data()->result();

        // Get teachers and join with mapel to show which teacher teaches which subject
        // Assuming 'id_mapel' exists in the 'guru' table and is a foreign key to 'mapel.id_mapel'
        $data['guru_mapel'] = $this->db->select('g.nama_guru, m.nama_mapel')
                                       ->from('guru g')
                                       ->join('mapel m', 'm.id_mapel = g.id_mapel', 'left')
                                       ->get()->result();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_mapel', $data);
        $this->load->view('template_admin/footer');
    }

    public function detail_mapel($id_mapel)
    {
        $this->load->model('m_mapel');
        $this->load->model('m_guru');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['mapel_detail'] = $this->m_mapel->get_mapel_by_id($id_mapel); // Need to add this function to M_mapel

        if (!$data['mapel_detail']) {
            show_404(); // Show 404 if subject not found
        }

        // Get teachers who teach this subject
        $data['guru_terkait'] = $this->db->get_where('guru', ['id_mapel' => $id_mapel])->result();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/detail_mapel', $data); // Need to create detail_mapel.php view
        $this->load->view('template_admin/footer');
    }

    public function update_mapel($id_mapel)
    {
        $this->load->model('m_mapel');
        $this->load->model('m_guru');

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['mapel_data'] = $this->m_mapel->get_mapel_by_id($id_mapel); // Need to add this function to M_mapel

        if (!$data['mapel_data']) {
            show_404(); // Show 404 if subject not found
        }

        // Get all teachers to populate the dropdown
        $data['guru_list'] = $this->m_guru->tampil_data()->result();

        // Handle form submission
        if ($this->input->post()) {
            $this->load->library('form_validation');

            // Set validation rules (adjust as needed)
            $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required|trim');
            $this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|trim');
            // Add validation for guru_pengampu if it's mandatory

            if ($this->form_validation->run() == false) {
                // Validation failed, reload the form view with errors
                $this->load->view('template_admin/nav');
                $this->load->view('admin/update_mapel', $data); // Need to create update_mapel.php view
                $this->load->view('template_admin/footer');
            } else {
                // Validation passed, prepare data and update database
                $update_data = [
                    'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                    'kode_mapel' => htmlspecialchars($this->input->post('kode_mapel', true)),
                    'updated_at' => date('Y-m-d H:i:s') // Assuming you have updated_at column
                    // Update other columns if necessary
                ];

                if ($this->m_mapel->update_mapel($id_mapel, $update_data)) { // Need to add this function to M_mapel
                    $this->session->set_flashdata('success', 'Mata pelajaran berhasil diperbarui!');
                    // Handle teacher update (similar to add_mapel_process)
                    $nip_guru = $this->input->post('nip_guru');
                    $guru_update_data = array('id_mapel' => null); // Set to NULL initially
                    if (!empty($nip_guru)) {
                         $guru_update_data['id_mapel'] = $id_mapel;
                    }
                    // Update the previously assigned guru (if any) to NULL
                    $this->db->where('id_mapel', $id_mapel);
                    $this->db->update('guru', array('id_mapel' => null));
                    // Update the newly selected guru (if any)
                    if (!empty($nip_guru)) {
                         $this->db->where('nip', $nip_guru);
                         $this->db->update('guru', array('id_mapel' => $id_mapel));
                    }

                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui mata pelajaran.');
                }

                redirect('admin/data_mapel');
            }
        } else {
            // Load the edit form view
            $this->load->view('template_admin/nav');
            $this->load->view('admin/update_mapel', $data); // Need to create update_mapel.php view
            $this->load->view('template_admin/footer');
        }
    }

    public function delete_mapel($id_mapel)
    {
        $this->load->model('m_mapel');

        // Before deleting the subject, set the id_mapel of any related teachers to NULL
        $this->db->where('id_mapel', $id_mapel);
        $this->db->update('guru', array('id_mapel' => null));

        if ($this->m_mapel->delete_mapel($id_mapel)) { // Need to add this function to M_mapel
            $this->session->set_flashdata('success', 'Mata pelajaran berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus mata pelajaran.');
        }

        redirect('admin/data_mapel');
    }

    // Function to load the add subject form view
    public function add_mapel()
    {
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        // Get all teachers to populate the dropdown
        $this->load->model('m_guru'); // Assuming you have an M_guru model
        $data['guru_list'] = $this->m_guru->tampil_data()->result();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/add_mapel', $data);
        $this->load->view('template_admin/footer');
    }

    // Function to process adding a new subject
    public function add_mapel_process()
    {
        $this->load->model('m_mapel');
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required|trim|is_unique[mapel.nama_mapel]', [
            'required' => 'Nama Mata Pelajaran wajib diisi.',
            'is_unique' => 'Nama Mata Pelajaran ini sudah ada.'
        ]);
         $this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required|trim|is_unique[mapel.kode_mapel]', [
            'required' => 'Kode Mata Pelajaran wajib diisi.',
            'is_unique' => 'Kode Mata Pelajaran ini sudah ada.'
        ]);
        $this->form_validation->set_rules('nip_guru', 'Guru Pengampu', 'required', [
            'required' => 'Harap pilih Guru Pengampu.',
        ]);

        if ($this->form_validation->run() == false) {
            // Validation failed, reload the form view with errors
            $data['user'] = $this->db->get_where('admin', ['email' =>
                $this->session->userdata('email')])->row_array();

            $this->load->view('template_admin/nav');
            $this->load->view('admin/add_mapel', $data);
            $this->load->view('template_admin/footer');
        } else {
            // Validation passed, prepare data and insert into database
            $data = [
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'kode_mapel' => htmlspecialchars($this->input->post('kode_mapel', true)),
                'created_at' => date('Y-m-d H:i:s'), // Assuming you have created_at column
                'nip' => htmlspecialchars($this->input->post('nip_guru', true)), // Add nip to the mapel table
            ];

            // Use the model to insert data
            if ($this->db->insert('mapel', $data)) {
                 $this->session->set_flashdata('success', 'Mata pelajaran berhasil ditambahkan!');
                 // Get the ID of the newly inserted subject
                 $new_mapel_id = $this->db->insert_id();

                 // Get the selected teacher's NIP from the form
                 $nip_guru = $this->input->post('nip_guru');

                 // If a teacher was selected, update the guru table
                 if (!empty($nip_guru)) {
                     $guru_update_data = array('id_mapel' => $new_mapel_id, 'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)));
                     $this->db->where('nip', $nip_guru);
                     $this->db->update('guru', $guru_update_data);
                     // Optional: Add a success/error message for the teacher update
                 }

             } else {
                  $this->session->set_flashdata('error', 'Gagal menambahkan mata pelajaran.');
             }

             // Redirect to the data mapel page
            redirect('admin/data_mapel');
        }
    }

    // Function to print subject data
    public function print_mapel()
    {
        $this->load->model('m_mapel');

        // Get all subjects using the model
        $data['mapel_list'] = $this->m_mapel->tampil_data()->result();

        // Get teachers and join with mapel to show which teacher teaches which subject
        // Assuming 'id_mapel' exists in the 'guru' table and is a foreign key to 'mapel.id_mapel'
        $data['guru_mapel'] = $this->db->select('g.nama_guru, m.nama_mapel')
                                       ->from('guru g')
                                       ->join('mapel m', 'm.id_mapel = g.id_mapel', 'left')
                                       ->get()->result();

        $this->load->view('admin/print_mapel', $data); // Need to create print_mapel.php view
    }

    // Management Jadwal

    public function data_jadwal()
    {
        $this->load->model('m_jadwal');
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['jadwal'] = $this->m_jadwal->tampil_data()->result();
        $this->load->view('template_admin/nav');
        $this->load->view('admin/data_jadwal', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_jadwal()
    {
        $this->load->model(['m_kelas', 'm_guru', 'm_mapel']);

        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['kelas_list'] = $this->m_kelas->tampil_data()->result();
        $data['guru_list'] = $this->m_guru->tampil_data()->result();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/add_jadwal', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_jadwal_process()
    {
        $this->load->model('m_jadwal');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Harap pilih Kelas.',
        ]);
        $this->form_validation->set_rules('nip', 'Guru', 'required', [
            'required' => 'Harap pilih Guru.',
        ]);
        $this->form_validation->set_rules('id_materi', 'Mata Pelajaran', 'required', [
            'required' => 'Harap pilih Mata Pelajaran.',
        ]);
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim', [
            'required' => 'Harap isi kolom Hari.',
        ]);
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required|trim', [
            'required' => 'Harap isi kolom Jam Mulai.',
        ]);
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required|trim', [
            'required' => 'Harap isi kolom Jam Selesai.',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->model(['m_kelas', 'm_guru', 'm_mapel']);
            $data['user'] = $this->db->get_where('admin', ['email' =>
                $this->session->userdata('email')])->row_array();
            $data['kelas_list'] = $this->m_kelas->tampil_data()->result();
            $data['guru_list'] = $this->m_guru->tampil_data()->result();

            $this->load->view('template_admin/nav');
            $this->load->view('admin/add_jadwal', $data);
            $this->load->view('template_admin/footer');
        } else {
            $id_kelas = $this->input->post('id_kelas', true);
            $nip = $this->input->post('nip', true);
            $id_mapel = $this->input->post('id_materi', true);
            $hari = htmlspecialchars($this->input->post('hari', true));
            $jam_mulai = htmlspecialchars($this->input->post('jam_mulai', true));
            $jam_selesai = htmlspecialchars($this->input->post('jam_selesai', true));

            // Get nama_kelas, nama_guru, nama_mapel based on their IDs
            $this->load->model(['m_kelas', 'm_guru', 'm_mapel']);
            $kelas_data = $this->m_kelas->detail_kelas($id_kelas);
            $guru_data = $this->m_guru->detail_guru($nip);
            $mapel_data = $this->m_mapel->get_mapel_by_id($id_mapel);

            // Check if a materi record exists for this mapel, guru, and kelas
            $materi_id_for_jadwal = null;
            $existing_materi = $this->db->get_where('materi', [
                'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
                'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
                'kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
            ])->row();

            if ($existing_materi) {
                $materi_id_for_jadwal = $existing_materi->id_materi;
            } else {
                // Create a new materi record if it doesn't exist
                $materi_data = [
                    'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
                    'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
                    'deskripsi' => 'Materi untuk jadwal ' . ($mapel_data ? $mapel_data->nama_mapel : ''),
                    'kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
                    'tanggal_upload' => date('Y-m-d'),
                    'nip' => $nip,
                    'id_kelas' => $id_kelas,
                    'id_mapel' => $id_mapel
                ];
                $this->db->insert('materi', $materi_data);
                $materi_id_for_jadwal = $this->db->insert_id();
            }

            $data = [
                'id_kelas' => $id_kelas,
                'nip' => $nip,
                'id_materi' => $materi_id_for_jadwal,
                'nama_kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
                'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
                'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
                'hari' => $hari,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->m_jadwal->input_data($data, 'jadwal')) {
                $this->session->set_flashdata('success_jadwal', 'Jadwal berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error_jadwal', 'Gagal menambahkan jadwal.');
            }

            redirect('admin/data_jadwal');
        }
    }

    public function update_jadwal($id_jadwal)
    {
        $this->load->model(['m_jadwal', 'm_kelas', 'm_guru', 'm_mapel']);
        $where = array('id_jadwal' => $id_jadwal);
        $data['user'] = $this->db->get_where('admin', ['email' =>
            $this->session->userdata('email')])->row_array();

        $data['jadwal_detail'] = $this->m_jadwal->detail_jadwal($id_jadwal);
        $data['kelas_list'] = $this->m_kelas->tampil_data()->result();
        $data['guru_list'] = $this->m_guru->tampil_data()->result();
        $data['mapel_list'] = $this->m_mapel->tampil_data()->result();

        $this->load->view('template_admin/nav');
        $this->load->view('admin/update_jadwal', $data);
        $this->load->view('template_admin/footer');
    }

    public function jadwal_edit()
    {
        $this->load->model('m_jadwal');

        $id_jadwal = $this->input->post('id_jadwal');
        $id_kelas = $this->input->post('id_kelas');
        $nip = $this->input->post('nip');
        $id_mapel = $this->input->post('id_materi');
        $hari = htmlspecialchars($this->input->post('hari', true));
        $jam_mulai = htmlspecialchars($this->input->post('jam_mulai', true));
        $jam_selesai = htmlspecialchars($this->input->post('jam_selesai', true));

        // Get nama_kelas, nama_guru, nama_mapel based on their IDs
        $this->load->model(['m_kelas', 'm_guru', 'm_mapel']);
        $kelas_data = $this->m_kelas->detail_kelas($id_kelas);
        $guru_data = $this->m_guru->detail_guru($nip);
        $mapel_data = $this->m_mapel->get_mapel_by_id($id_mapel);

        // Check if a materi record exists for this mapel, guru, and kelas
        $materi_id_for_jadwal = null;
        $existing_materi = $this->db->get_where('materi', [
            'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
            'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
            'kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
        ])->row();

        if ($existing_materi) {
            $materi_id_for_jadwal = $existing_materi->id_materi;
        } else {
            // Create a new materi record if it doesn't exist
            $materi_data = [
                'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
                'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
                'deskripsi' => 'Materi untuk jadwal ' . ($mapel_data ? $mapel_data->nama_mapel : ''),
                'kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
                'tanggal_upload' => date('Y-m-d'),
                'nip' => $nip,
                'id_kelas' => $id_kelas,
                'id_mapel' => $id_mapel
            ];
            $this->db->insert('materi', $materi_data);
            $materi_id_for_jadwal = $this->db->insert_id();
        }

        $data = array(
            'id_kelas' => $id_kelas,
            'nip' => $nip,
            'id_materi' => $materi_id_for_jadwal,
            'nama_kelas' => $kelas_data ? $kelas_data->nama_kelas : null,
            'nama_guru' => $guru_data ? $guru_data->nama_guru : null,
            'nama_mapel' => $mapel_data ? $mapel_data->nama_mapel : null,
            'hari' => $hari,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'updated_at' => date('Y-m-d H:i:s'),
        );

        $where = array(
            'id_jadwal' => $id_jadwal,
        );

        $this->m_jadwal->update_data($where, $data, 'jadwal');
        $this->session->set_flashdata('success_edit_jadwal', 'berhasil');
        redirect('admin/data_jadwal');
    }

    public function delete_jadwal($id_jadwal)
    {
        $this->load->model('m_jadwal');
        $where = array('id_jadwal' => $id_jadwal);
        $this->m_jadwal->delete_jadwal($where, 'jadwal');
        $this->session->set_flashdata('success_delete_jadwal', 'berhasil');
        redirect('admin/data_jadwal');
    }

    public function get_mapel_by_guru()
    {
        $this->load->model('m_mapel');
        $nip = $this->input->post('nip');
        
        // Debug: Log the NIP
        log_message('debug', 'NIP received: ' . $nip);
        
        $mapel_list = $this->m_mapel->get_mapel_by_nip($nip);
        
        // Debug: Log the query result
        log_message('debug', 'Mapel list: ' . json_encode($mapel_list));
        
        ob_clean(); // Clean (erase) the output buffer
        echo json_encode($mapel_list);
        die(); // Stop further execution
    }

}


    
