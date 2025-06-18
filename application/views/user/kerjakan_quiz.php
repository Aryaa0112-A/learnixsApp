<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title>Kerjakan Quiz - Learnix's Education</title>
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

    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kerjakan Quiz</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?= $tugas->judul_tugas ?></h3>
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

                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
                                    <p>Silakan kerjakan quiz dengan teliti. Setelah mengumpulkan, Anda akan langsung melihat nilai Anda.</p>
                                </div>

                                <?= form_open('user/submit_quiz_answers/' . $tugas->id_tugas, ['id' => 'quizForm']) ?>
                                <?php $no = 1; ?>
                                <?php foreach ($soal_quiz as $soal) : ?>
                                    <div class="form-group">
                                        <label for="soal_<?= $soal->id_soal ?>">Soal <?= $no++ ?></label>
                                        <p><?= $soal->pertanyaan ?></p>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="jawaban_<?= $soal->id_soal ?>_a" name="jawaban_<?= $soal->id_soal ?>" value="A" class="custom-control-input" required>
                                            <label class="custom-control-label" for="jawaban_<?= $soal->id_soal ?>_a">A. <?= $soal->pilihan_a ?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="jawaban_<?= $soal->id_soal ?>_b" name="jawaban_<?= $soal->id_soal ?>" value="B" class="custom-control-input" required>
                                            <label class="custom-control-label" for="jawaban_<?= $soal->id_soal ?>_b">B. <?= $soal->pilihan_b ?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="jawaban_<?= $soal->id_soal ?>_c" name="jawaban_<?= $soal->id_soal ?>" value="C" class="custom-control-input" required>
                                            <label class="custom-control-label" for="jawaban_<?= $soal->id_soal ?>_c">C. <?= $soal->pilihan_c ?></label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="jawaban_<?= $soal->id_soal ?>_d" name="jawaban_<?= $soal->id_soal ?>" value="D" class="custom-control-input" required>
                                            <label class="custom-control-label" for="jawaban_<?= $soal->id_soal ?>_d">D. <?= $soal->pilihan_d ?></label>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>

                                <button type="submit" class="btn btn-primary">Kumpulkan Jawaban</button>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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

    document.getElementById('quizForm').addEventListener('submit', function(e) {
        var radios = document.querySelectorAll('input[type="radio"]');
        var answered = {};
        var allAnswered = true;

        // Check if all questions are answered
        for (var i = 0; i < radios.length; i++) {
            var name = radios[i].name;
            if (!answered[name]) {
                answered[name] = false;
            }
            if (radios[i].checked) {
                answered[name] = true;
            }
        }

        // Check if any question is unanswered
        for (var name in answered) {
            if (!answered[name]) {
                allAnswered = false;
                break;
            }
        }

        if (!allAnswered) {
            e.preventDefault();
            alert('Silakan jawab semua pertanyaan sebelum mengumpulkan!');
        }
    });
    </script>

</body>

</html> 