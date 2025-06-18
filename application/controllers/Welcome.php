<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
      $this->load->view('template/nav');
      $this->load->view('index');
      $this->load->view('template/footer');
    }

    public function login_siswa()
    {
      $this->load->library('session');
      $this->load->view('user/login');
    }

    public function validateLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('false-login', true);
            $this->session->set_flashdata('validateLoginFalse', $this->form_validation->error_array());
            $this->load->library('user_agent');
            redirect($this->agent->referrer());
        } else {
            //validasi sukses
            $this->login();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('success-logout', 'Berhasil!');
        redirect(base_url('welcome'));
    }

    private function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('siswa', ['email' => $email])->row_array();

        if ($user) {
            //user ada
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'logged_in' => true,
                        'id_siswa' => $user['id_siswa'],
                        'nama' => $user['nama'],
                        'id_kelas' => $user['id_kelas'],
                    ];

                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('success-login-user', 'Berhasil!');
                    redirect(base_url('user'));
                } else {
                    $this->session->set_flashdata('fail-pass', 'Gagal!');
                    redirect(base_url('welcome'));
                }
            } else {
                $this->session->set_flashdata('fail-email', 'Gagal!');
                redirect(base_url('welcome'));
            }
        } else {
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('welcome'));
        }
    }

    public function admin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            //validasi sukses
            $this->adminlogin();
        }
    }

    private function adminlogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'nama' => $user['username'],
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success-login-user', 'Berhasil!');
                redirect(base_url('admin'));
            } else {
                $this->session->set_flashdata('email', $email);
                $this->session->set_flashdata('password', $password);
                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('welcome/admin'));
            }
        } else {
            $this->session->set_flashdata('email', $email);
            $this->session->set_flashdata('password', $password);
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('welcome/admin'));
        }
    }

    public function tentang()
    {
        $this->load->view('template/nav');
        $this->load->view('tentang');
        $this->load->view('template/footer');
    }

    public function pelajaran()
    {
        $this->load->view('template/nav');
        $this->load->view('pelajaran');
        $this->load->view('template/footer');
    }

    public function kontak()
    {
        $this->load->view('template/nav');
        $this->load->view('kontak');
        $this->load->view('template/footer');
    }

    public function verify()
    {
        // Fitur verifikasi email telah dinonaktifkan
        // Karena pendaftaran hanya dapat dilakukan oleh admin
        redirect('welcome');
    }

    // Guru
    public function guru()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('guru/login');
        } else {
            //validasi sukses
            $this->guru_login_process();
        }
    }

    private function guru_login_process()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('guru', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'nama_guru' => $user['nama_guru'],
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('success-login-user', 'Berhasil!');
                redirect(base_url('guru'));
            } else {
                $this->session->set_flashdata('email', $email);
                $this->session->set_flashdata('password', $password);
                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('welcome/guru'));
            }
        } else {
            $this->session->set_flashdata('email', $email);
            $this->session->set_flashdata('password', $password);
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('welcome/guru'));
        }
    }

    public function email()
    {
        $this->load->view('template/email-template');
    }

    public function jurusan()
    {
        $data['title'] = 'Jurusan - SMK Teknologi Pilar Bangsa';
        $this->load->view('template/nav');
        $this->load->view('jurusan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail_jurusan($slug = null)
    {
        if (!$slug) {
            redirect('welcome/jurusan');
        }

        $data['title'] = 'Detail Jurusan - SMK Teknologi Pilar Bangsa';
        $data['slug'] = $slug;
        
        // Data jurusan
        if ($slug == 'multimedia') {
            $data['jurusan'] = [
                'nama' => 'Multimedia / DKV',
                'singkatan' => 'MM/DKV',
                'deskripsi' => 'Program keahlian dengan fokus pada desain grafis, animasi, fotografi, dan produksi video yang bernilai tambah.',
                'gambar' => 'multimedia.png',
                'akreditasi' => 'A',
                'visi' => 'Menjadi pusat unggulan dalam pengembangan kompetensi multimedia dan desain visual yang inovatif dan berdaya saing global.',
                'misi' => [
                    'Menyelenggarakan pendidikan dan pelatihan berbasis industri kreatif',
                    'Mengembangkan keterampilan dan kreativitas siswa dalam bidang multimedia dan desain visual',
                    'Membekali siswa dengan kemampuan kewirausahaan di bidang industri kreatif',
                    'Mempersiapkan lulusan yang siap kerja, kompeten, profesional, dan berakhlak mulia'
                ],
                'kompetensi' => [
                    'Desain Grafis Digital',
                    'Animasi 2D dan 3D',
                    'Fotografi dan Videografi',
                    'Web Design dan UI/UX',
                    'Branding dan Identitas Visual',
                    'Periklanan Digital'
                ],
                'prospek_kerja' => [
                    'Desainer Grafis',
                    'Animator',
                    'Video Editor',
                    'Fotografer',
                    'Web Designer',
                    'Pengembang Konten Digital',
                    'Wirausahawan Bidang Industri Kreatif'
                ],
                'fasilitas' => [
                    'Laboratorium Komputer dengan Software Industri Terbaru',
                    'Studio Fotografi',
                    'Studio Rekaman Video',
                    'Ruang Gambar dan Desain',
                    'Perpustakaan Referensi Visual dan Multimedia'
                ],
                'info_tambahan' => 'Program dengan nama DKV untuk kelas 10 dan Multimedia untuk kelas 11-12'
            ];
        } elseif ($slug == 'tkro') {
            $data['jurusan'] = [
                'nama' => 'TKRO / TKR',
                'singkatan' => 'TKRO/TKR',
                'deskripsi' => 'Program keahlian yang mempelajari tentang perawatan, perbaikan, dan pemeliharaan kendaraan ringan dengan teknologi terkini.',
                'gambar' => 'tkr.png',
                'akreditasi' => 'A',
                'visi' => 'Menjadi pusat pendidikan otomotif terkemuka yang menghasilkan teknisi profesional dan berdaya saing.',
                'misi' => [
                    'Menyelenggarakan pendidikan dan pelatihan yang sesuai dengan standar industri otomotif',
                    'Mengembangkan program pembelajaran yang membekali siswa dengan keterampilan teknis dan non-teknis di bidang otomotif',
                    'Menjalin kerjasama dengan dunia industri untuk meningkatkan kompetensi siswa',
                    'Mempersiapkan lulusan yang siap kerja, mandiri, dan berakhlak mulia'
                ],
                'kompetensi' => [
                    'Sistem Pemindah Tenaga',
                    'Perawatan Mesin Kendaraan Ringan',
                    'Sistem Kelistrikan Otomotif',
                    'Sistem Rem dan Kemudi',
                    'Sistem Suspensi',
                    'Diagnosis Kerusakan Mesin'
                ],
                'prospek_kerja' => [
                    'Mekanik Otomotif',
                    'Service Advisor',
                    'Teknisi Laboratorium Uji Kendaraan',
                    'Wirausaha Bengkel',
                    'Staf Quality Control Industri Otomotif',
                    'Instruktur/Pengajar Bidang Otomotif'
                ],
                'fasilitas' => [
                    'Bengkel Praktik Otomotif Lengkap',
                    'Engine Stand untuk Praktik',
                    'Lift Kendaraan',
                    'Alat Diagnosis Modern',
                    'Ruang Teori Multimedia'
                ],
                'info_tambahan' => 'Program dengan nama TKR untuk kelas 10 dan TKRO untuk kelas 11-12'
            ];
        } elseif ($slug == 'otkp') {
            $data['jurusan'] = [
                'nama' => 'OTKP / MP',
                'singkatan' => 'OTKP/MP',
                'deskripsi' => 'Program keahlian yang mempelajari administrasi kantor, komunikasi bisnis, dan manajemen perkantoran modern.',
                'gambar' => 'adm.png',
                'akreditasi' => 'A',
                'visi' => 'Menjadi program keahlian unggulan dalam menghasilkan tenaga administrasi dan manajemen perkantoran yang profesional di era digital.',
                'misi' => [
                    'Menyelenggarakan pendidikan yang membekali siswa dengan keterampilan administrasi dan manajemen perkantoran modern',
                    'Mengembangkan sikap profesional, disiplin, dan etika kerja',
                    'Mempersiapkan siswa untuk dapat beradaptasi dengan perkembangan teknologi informasi dan manajemen',
                    'Membangun kerjasama dengan dunia usaha/industri untuk meningkatkan kualitas pembelajaran'
                ],
                'kompetensi' => [
                    'Manajemen Perkantoran Digital',
                    'Kearsipan dan Dokumentasi',
                    'Komunikasi Bisnis',
                    'Administrasi Keuangan',
                    'Aplikasi Perkantoran Modern',
                    'Korespondensi Bahasa Indonesia dan Inggris',
                    'Kepemimpinan dan Supervisi'
                ],
                'prospek_kerja' => [
                    'Manajer Kantor',
                    'Sekretaris',
                    'Staf Administrasi',
                    'Customer Service',
                    'Administrator Sistem Kantor',
                    'Human Resource Staff',
                    'Wirausaha Bidang Layanan Bisnis'
                ],
                'fasilitas' => [
                    'Laboratorium Administrasi Perkantoran',
                    'Ruang Praktik Simulasi Perkantoran',
                    'Lab Komputer dengan Aplikasi Perkantoran Terkini',
                    'Mini Office',
                    'Perpustakaan Referensi Manajemen dan Administrasi'
                ],
                'info_tambahan' => 'Program dengan nama MP untuk kelas 10 dan OTKP untuk kelas 11-12'
            ];
        } else {
            redirect('welcome/jurusan');
        }

        $this->load->view('template/nav');
        $this->load->view('jurusan/detail', $data);
        $this->load->view('template/footer');
    }

}

