<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Learnify dibuat ditujukan agar para siswa dan guru dapat terus belajar dan mengajar dimana saja dan kapan saja." name="Description" />
    <meta content="Learnify, E-learning, " name="keywords" />
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <title>SMK - Teknologi Pilar Bangsa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/popper.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/particles/banner-particles.js"></script>
    <script type="text/javascript">
        $(document).ready(() => {
            // Mengaktifkan menu navigasi berdasarkan segment URL
            $("#nav<?= $this->uri->segment(2); ?>").addClass('active');
            
            // Mengaktifkan menu JURUSAN saat berada di halaman detail jurusan
            const currentUrl = window.location.href;
            if (currentUrl.includes('detail_jurusan')) {
                $("#navjurusan").addClass('active');
                
                // Menambahkan class pada submenu yang aktif
                if (currentUrl.includes('multimedia')) {
                    $(".dropdown-menu .nav-item a[href*='multimedia']").addClass('multimedia-link').parent().addClass('active');
                } else if (currentUrl.includes('tkr')) {
                    $(".dropdown-menu .nav-item a[href*='tkr']").addClass('tkr-link').parent().addClass('active');
                } else if (currentUrl.includes('administrasi-perkantoran')) {
                    $(".dropdown-menu .nav-item a[href*='administrasi-perkantoran']").addClass('adm-link').parent().addClass('active');
                }
            }
            
            // Script to handle sticky header animation
            $(window).scroll(function() {
                if ($(document).scrollTop() > 50) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
            
            // Handle dropdown menu for mobile devices
            $('.dropdown-toggle').on('click', function(e) {
                if ($(window).width() < 992) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close any other open menus
                    $('.dropdown').not($(this).parent()).removeClass('show');
                    $('.dropdown-menu').not($(this).siblings('.dropdown-menu')).removeClass('show');
                    
                    // Toggle current menu
                    $(this).parent().toggleClass('show');
                    $(this).siblings('.dropdown-menu').toggleClass('show');
                    
                    // Adjust height for better animation
                    if ($(this).siblings('.dropdown-menu').hasClass('show')) {
                        $(this).siblings('.dropdown-menu').css('max-height', '500px');
                    } else {
                        $(this).siblings('.dropdown-menu').css('max-height', '0');
                    }
                }
            });
            
            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if ($(window).width() < 992) {
                    if (!$(e.target).closest('.dropdown').length) {
                        $('.dropdown').removeClass('show');
                        $('.dropdown-menu').removeClass('show');
                        $('.dropdown-menu').css('max-height', '0');
                    }
                }
            });
        })
    </script>

</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="top_menu">
            <div class="container">
                <div class="top-menu-wrapper">
                    <div class="top-contact">
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope"></i>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=teknologi.pilarbangsa@yahoo.com" target="_blank">teknologi.pilarbangsa@yahoo.com</a>
                        </div>
                        <div class="contact-item">
                            <i class="fa-brands fa-whatsapp"></i>
                            <a href="https://wa.me/6282111103042" target="_blank">+62 821 1110 3042</a>
                        </div>
                    </div>
                    <div class="top-social">
                        <a href="<?= base_url('welcome/login_siswa') ?>" class="e-learning-btn">
                            <i class="fa fa-graduation-cap"></i> E-Learning
                        </a>
                </div>
                </div>
            </div>
        </div>

        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="<?= base_url('welcome') ?>">
                        <div class="brand-container">
                            <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo SMK Teknologi Pilar Bangsa">
                            <div class="brand-text">
                                <span class="brand-title">SMK Teknologi Pilar Bangsa</span>
                                <span class="brand-tagline">Membangun Generasi Unggul</span>
                            </div>
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item" id="nav"><a class="nav-link" href="<?= base_url('welcome') ?>">Beranda</a></li>
                            <li class="nav-item" id="navtentang"><a class="nav-link" href="<?= base_url('welcome/tentang') ?>">Tentang</a>
                            </li>
                            <li class="nav-item submenu dropdown" id="navjurusan">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jurusan <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-jurusan">
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('welcome/detail_jurusan/multimedia') ?>"><i class="fa fa-tv fa-fw"></i> <span>Multimedia / DKV</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('welcome/detail_jurusan/otkp') ?>"><i class="fa fa-desktop fa-fw"></i> <span>OTKP / MP</span></a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?= base_url('welcome/detail_jurusan/tkro') ?>"><i class="fa fa-car fa-fw"></i> <span>TKRO / TKR</span></a></li>
                                </ul>
                            </li>
                            <li class="nav-item" id="navkontak"><a class="nav-link" href="<?= base_url('welcome/kontak') ?>">Kontak</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ END Header Menu Area =================-->