<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title>Selamat datang - <?php
                            $data['user'] = $this->db->get_where('siswa', ['email' =>
                            $this->session->userdata('email')])->row_array();
                            echo $data['user']['nama'];
                            ?> - Halaman Siswa Learnix's</title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main css -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/user_style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>

</head>

<body style="overflow-x:hidden;background-color:#fbf9fa">


    <!-- Start Navigation Bar -->
    <header class="header_area" style="background-color: white !important;">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?= base_url('welcome') ?>"><img src="<?= base_url('assets/') ?>img/your.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)">
                                <i class="fas fa-user-circle mr-1"></i> Hai, <?php 
                                $data['user'] = $this->db->get_where('siswa', ['email' =>
                                $this->session->userdata('email')])->row_array();
                                echo $data['user']['nama'];
                                    ?></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user') ?>">
                                <i class="fas fa-book-open mr-1"></i>Materi</a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user/tugas') ?>">
                                <i class="fas fa-tasks mr-1"></i>Tugas</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/jadwal') ?>">
                                <i class="fas fa-calendar-alt mr-1"></i>Jadwal</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('welcome/logout') ?>">
                                <i class="fas fa-sign-out-alt mr-1"></i> Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Navigation Bar -->


    <!-- Start Greetings Card -->
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <div class="col-md-12 mt-1">
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Selamat Datang
                        di Learnix's <span style="font-size: 40px;">👋🏻
                        </span> </h1>
                    <p>Halo Siswa! Ini merupakan halaman Tugas Learnix's! Silakan cek daftar tugas yang harus kamu kerjakan di bawah ini. Jangan lupa kerjakan sebelum deadline dan semangat belajar!</p>
                    <hr>
                    <div class="user-profile" data-aos="fade-down" data-aos-duration="1700">
                        <h4 class="mb-2"><i class="fas fa-user-graduate mr-2"></i><?php
                         $data['user'] = $this->db->get_where('siswa', ['email' =>
                         $this->session->userdata('email')])->row_array();
                         echo $data['user']['nama']; ?> - Siswa Learnix's</h4>
                        <p data-aos="fade-down" data-aos-duration="1800">Silahkan pilih tugas yang akan kamu akses
                            dibawah
                            ini!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Greetings Card -->

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon bg-primary-light mr-3">
                                    <i class="fas fa-tasks text-primary"></i>
                                </div>
                                <div>
                                    <p class="stats-title">Total Tugas</p>
                                    <h3 class="stats-number"><?php echo isset($tugas) ? count($tugas) : 0; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon bg-success-light mr-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <div>
                                    <p class="stats-title">Sudah Dikerjakan</p>
                                    <h3 class="stats-number">
                                        <?php
                                        $completed = 0;
                                        if (isset($tugas) && !empty($tugas)) {
                                            foreach ($tugas as $t) {
                                                if ($t->status == 'sudah') {
                                                    $completed++;
                                                }
                                            }
                                        }
                                        echo $completed;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card stats-card h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stats-icon bg-warning-light mr-3">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                                <div>
                                    <p class="stats-title">Belum Dikerjakan</p>
                                    <h3 class="stats-number">
                                        <?php
                                        $pending = 0;
                                        if (isset($tugas) && !empty($tugas)) {
                                            foreach ($tugas as $t) {
                                                if ($t->status != 'sudah') {
                                                    $pending++;
                                                }
                                            }
                                        }
                                        echo $pending;
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Task List -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Tugas</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Tugas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($tugas)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $t->judul_tugas ?></td>
                                                <td><?= $t->nama_mapel ?></td>
                                                <td><?= date('d-m-Y H:i', strtotime($t->deadline)) ?></td>
                                                <td>
                                                    <?php
                                                    if (isset($t->status)) {
                                                        if ($t->status == 'sudah') {
                                                            echo '<span class="badge badge-success">Selesai</span>';
                                                        } elseif ($t->status == 'terlambat') {
                                                            echo '<span class="badge badge-danger">Terlambat</span>';
                                                        } else {
                                                            echo '<span class="badge badge-warning">Belum Dikerjakan</span>';
                                                        }
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($t->nilai)) : ?>
                                                        <?= number_format($t->nilai, 2) ?>
                                                    <?php else : ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($t->status) && $t->status == 'belum' && strtotime($t->deadline) >= time()) : ?>
                                                        <?php if (isset($t->jumlah_soal) && $t->jumlah_soal > 0) : ?>
                                                            <a href="<?= base_url('user/kerjakan_quiz/' . $t->id_tugas) ?>" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-pencil-alt"></i> Kerjakan Quiz
                                                            </a>
                                                        <?php else : ?>
                                                            <a href="<?= base_url('user/kerjakan_tugas/' . $t->id_tugas) ?>" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-upload"></i> Kumpulkan Tugas
                                                            </a>
                                                        <?php endif; ?>
                                                    <?php elseif (isset($t->status) && $t->status == 'sudah') : ?>
                                                        <a href="<?= base_url('user/detail_tugas/' . $t->id_tugas) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Lihat Detail
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal detail jika perlu -->
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="7" class="text-center">Tidak ada tugas</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Start Footer -->
    <footer class="footer-area" style="margin-top: 100px; background-color: #0a193d; color: white;">
        <div class="container">
            <div class="row pt-5 pb-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <img src="<?= base_url('assets/') ?>img/logo-white.png" alt="Logo" class="mb-3" style="height: 50px;">
                        <p>SMK Teknologi Pilar Bangsa adalah lembaga pendidikan menengah kejuruan yang berdedikasi untuk mengembangkan generasi muda dengan keahlian teknologi dan keterampilan yang relevan untuk masa depan.</p>
                        <div class="footer-address">
                            <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Raya Mauk KM.07, Karawaci, Sepatan Timur, Kabupaten Tangerang, Banten 15520</p>
                            <p><i class="fas fa-phone mr-2"></i> +62 821 1110 9642</p>
                            <p><i class="fas fa-envelope mr-2"></i> teknologi.pilarbangsa@yahoo.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Tentang Kami</h4>
                        <ul class="footer-menu">
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> Tentang Sekolah</a></li>
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Jurusan</h4>
                        <ul class="footer-menu">
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> Multimedia / DKV</a></li>
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> OTKP / MP</a></li>
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> TKRO / TSM</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">E-Learning</h4>
                        <ul class="footer-menu">
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> Masuk Siswa</a></li>
                            <li><a href="#"><i class="fas fa-angle-right mr-2"></i> Masuk Guru</a></li>
                        </ul>
                        <h4 class="footer-widget-title mt-4">Media Sosial</h4>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom d-flex justify-content-between align-items-center py-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                        <div class="copyright-text">
                            <p class="mb-0">© 2025 SMK Teknologi Pilar Bangsa. All Rights Reserved.</p>
                        </div>
                        <div class="developer-text text-right">
                            <p class="mb-0">Developed with <i class="fas fa-heart text-danger"></i> by <a href="#" class="text-white">The Debuggers</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init();
        
        // Fix untuk navbar toggler - menggunakan solusi manual
        $(document).ready(function() {
            // Hapus event listener default
            $('.navbar-toggler').off('click');
            
            // Buat toggle manual
            var navbarToggler = $('.navbar-toggler');
            var navbarCollapse = $('#navbarSupportedContent');
            
            // Tentukan status awal
            var isOpen = false;
            
            // Event listener baru
            navbarToggler.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle status
                isOpen = !isOpen;
                
                // Terapkan perubahan
                if (isOpen) {
                    navbarCollapse.addClass('show');
                    navbarToggler.removeClass('collapsed');
                    navbarToggler.attr('aria-expanded', 'true');
                } else {
                    navbarCollapse.removeClass('show');
                    navbarToggler.addClass('collapsed');
                    navbarToggler.attr('aria-expanded', 'false');
                }
                
                return false;
            });
            
            // Tutup menu saat klik di luar
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.navbar-collapse').length && 
                    !$(e.target).closest('.navbar-toggler').length && 
                    isOpen) {
                    
                    navbarCollapse.removeClass('show');
                    navbarToggler.addClass('collapsed');
                    navbarToggler.attr('aria-expanded', 'false');
                    isOpen = false;
                }
            });
        });
    </script>

</body>

</html>
