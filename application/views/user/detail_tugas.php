<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title><?= $title ?> - Learnix's</title>
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
                                <i class="fas fa-book-open mr-1"></i> Halaman Materi</a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user/tugas') ?>">
                                <i class="fas fa-tasks mr-1"></i> Halaman Tugas</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/jadwal') ?>">
                                <i class="fas fa-calendar-alt mr-1"></i> Halaman Jadwal</a>
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
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Detail Tugas <span style="font-size: 40px;">📝</span></h1>
                    <p>Berikut adalah detail tugas yang telah diberikan oleh guru. Pastikan untuk memahami instruksi dan mengerjakan tugas sebelum deadline.</p>
                    <hr>
                    <div class="user-profile">
                        <a href="<?= base_url('user/tugas') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Tugas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Greetings Card -->

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i> <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mobile-header"><?= $tugas->judul_tugas ?></h2>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-primary-light mr-3">
                                        <i class="fas fa-book text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="stats-title">Mata Pelajaran</p>
                                        <h5 class="font-weight-bold"><?= $tugas->nama_mapel ?></h5>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-info-light mr-3">
                                        <i class="fas fa-users text-info"></i>
                                    </div>
                                    <div>
                                        <p class="stats-title">Kelas</p>
                                        <h5 class="font-weight-bold"><?= $tugas->kelas ?></h5>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-warning-light mr-3">
                                        <i class="fas fa-clock text-warning"></i>
                                    </div>
                                    <div>
                                        <p class="stats-title">Deadline</p>
                                        <h5 class="font-weight-bold"><?= date('d F Y', strtotime($tugas->deadline)) ?></h5>
                                        <p><?= date('H:i', strtotime($tugas->deadline)) ?> WIB</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="stats-icon bg-<?= $submission ? ($submission->status == 'sudah' ? 'success' : 'danger') : (strtotime($tugas->deadline) < time() ? 'danger' : 'warning') ?>-light mr-3">
                                        <i class="fas fa-<?= $submission ? ($submission->status == 'sudah' ? 'check-circle' : 'exclamation-circle') : (strtotime($tugas->deadline) < time() ? 'exclamation-circle' : 'hourglass-half') ?> text-<?= $submission ? ($submission->status == 'sudah' ? 'success' : 'danger') : (strtotime($tugas->deadline) < time() ? 'danger' : 'warning') ?>"></i>
                                    </div>
                                    <div>
                                        <p class="stats-title">Status</p>
                                        <?php if ($submission) : ?>
                                            <?php if ($submission->status == 'sudah') : ?>
                                                <span class="badge bg-success text-white">
                                                    <i class="fas fa-check-circle mr-1"></i> Sudah Dikerjakan
                                                </span>
                                            <?php else : ?>
                                                <span class="badge bg-danger text-white">
                                                    <i class="fas fa-exclamation-circle mr-1"></i> Terlambat
                                                </span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <?php if (strtotime($tugas->deadline) < time()) : ?>
                                                <span class="badge bg-danger text-white">
                                                    <i class="fas fa-exclamation-circle mr-1"></i> Terlambat
                                                </span>
                                            <?php else : ?>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-hourglass-half mr-1"></i> Belum Dikerjakan
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <?php if ($submission) : ?>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="stats-icon bg-primary-light mr-3">
                                            <i class="fas fa-calendar-check text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="stats-title">Tanggal Submit</p>
                                            <h5 class="font-weight-bold"><?= date('d F Y', strtotime($submission->tanggal_submit)) ?></h5>
                                            <p><?= date('H:i', strtotime($submission->tanggal_submit)) ?> WIB</p>
                                        </div>
                                    </div>
                                    
                                    <?php if ($submission->nilai) : ?>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="stats-icon bg-success-light mr-3">
                                                <i class="fas fa-star text-success"></i>
                                            </div>
                                            <div>
                                                <p class="stats-title">Nilai</p>
                                                <h5 class="font-weight-bold"><?= $submission->nilai ?></h5>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($tugas->file_tugas) : ?>
                            <div class="mb-4">
                                <a href="<?= base_url('tugas/download/' . $tugas->id_tugas) ?>" class="btn btn-primary btn-lg">
                                    <i class="fas fa-download mr-2"></i> Download File Tugas
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($submission) : ?>
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-upload mr-2"></i> File Submission</h5>
                                </div>
                                <div class="card-body">
                                    <a href="<?= base_url('uploads/tugas/' . $submission->file_submission) ?>" class="btn btn-info" target="_blank">
                                        <i class="fas fa-file mr-2"></i> Lihat File yang Dikumpulkan
                                    </a>
                                </div>
                            </div>
                            
                            <?php if ($submission->komentar) : ?>
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="fas fa-comment-dots mr-2"></i> Komentar Guru</h5>
                                    </div>
                                    <div class="card-body">
                                        <?= nl2br($submission->komentar) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (strtotime($tugas->deadline) > time()) : ?>
                                <div class="text-center py-4">
                                    <a href="<?= base_url('user/submit_tugas/' . $tugas->id_tugas) ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-upload mr-2"></i> Kumpul Tugas
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> Maaf, deadline pengumpulan tugas telah berakhir.
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
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