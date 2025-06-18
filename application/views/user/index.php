<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <!-- Title -->
    <title>Selamat Datang - <?php 
        $data['user'] = $this->db->get_where('siswa', ['email' =>
                            $this->session->userdata('email')])->row_array();
                            echo $data['user']['nama'];
    ?> - Halaman Siswa Learnix's</title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
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

<body>

    <!-- Sweetalert untuk menampilkan pesan berhasil login -->
    <?php if ($this->session->flashdata('success-login-user')): ?>
    <script>
        // Pendekatan baru: Selalu tampilkan popup pada setiap login baru
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang kembali!',
            showConfirmButton: false,
            timer: 2500
        });
        
        // Tambahkan kode untuk menghapus flash data setelah ditampilkan
        // agar tidak muncul lagi saat refresh
        <?php $this->session->unset_userdata('success-login-user'); ?>
    </script>
    <?php endif;?>

    <!-- Start Navigation Bar -->
    <header class="header_area">
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
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i class="fa fa-user-circle mr-1"></i> 
                                    <?php 
                                 $data['user'] = $this->db->get_where('siswa', ['email' =>
                                 $this->session->userdata('email')])->row_array();
                                 echo $data['user']['nama'];
                                    ?>
                                </a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>"><i class="fa fa-book-open mr-1"></i> Materi</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/tugas') ?>"><i class="fa fa-tasks mr-1"></i> Tugas</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('user/jadwal') ?>"><i class="fa fa-calendar mr-1"></i> Jadwal</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-danger" href="<?= base_url('welcome/logout') ?>"><i class="fa fa-sign-out-alt mr-1"></i> Log Out</a>
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
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400">
            <div class="row">
                <div class="col-md-12 mt-1">
                    <h1 class="display-4" data-aos="fade-down" data-aos-duration="1400">
                        Selamat Datang di Learnix's 
                        <span style="font-size: 40px;">👋🏻</span>
                    </h1>
                    <p class="lead">Halo Siswa! Ini merupakan halaman Materi learnix's! Silahkan pilih materi yang akan kamu
                        akses dan pilih mata pelajaran yang ingin kamu pelajari. Selamat belajar ya students!</p>
                    <hr>
                    <div class="d-flex align-items-center">
                        <div class="profile-badge mr-3">
                            <i class="fa fa-user-graduate fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 data-aos="fade-down" data-aos-duration="1700">
                                <?php
                         $data['user'] = $this->db->get_where('siswa', ['email' =>
                         $this->session->userdata('email')])->row_array();
                                    echo $data['user']['nama']; ?> - Siswa Learnix's
                            </h4>
                            <p class="text-muted" data-aos="fade-down" data-aos-duration="1800">
                                Silahkan pilih materi yang akan kamu akses dibawah ini!
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Greetings Card -->

    <br>

    <!-- Start Statistics Cards -->
    <div class="container">
        <div class="row">
            <!-- Statistik Materi -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 stats-card" data-aos="fade-up" data-aos-duration="800">
                    <div class="card-body d-flex align-items-center">
                        <div class="stats-icon bg-primary-light mr-3">
                            <i class="fa fa-book text-primary"></i>
                        </div>
                        <div>
                            <h6 class="stats-title">Total Materi</h6>
                            <h3 class="stats-number"><?= !empty($materi) ? count($materi) : '0' ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Tugas -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 stats-card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body d-flex align-items-center">
                        <div class="stats-icon bg-success-light mr-3">
                            <i class="fa fa-tasks text-success"></i>
                        </div>
                        <div>
                            <h6 class="stats-title">Tugas Aktif</h6>
                            <h3 class="stats-number">5</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Jadwal -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 stats-card" data-aos="fade-up" data-aos-duration="1200">
                    <div class="card-body d-flex align-items-center">
                        <div class="stats-icon bg-warning-light mr-3">
                            <i class="fa fa-calendar-alt text-warning"></i>
                        </div>
                        <div>
                            <h6 class="stats-title">Jadwal Hari Ini</h6>
                            <h3 class="stats-number">3</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Nilai -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card h-100 stats-card" data-aos="fade-up" data-aos-duration="1400">
                    <div class="card-body d-flex align-items-center">
                        <div class="stats-icon bg-info-light mr-3">
                            <i class="fa fa-chart-line text-info"></i>
                        </div>
                        <div>
                            <h6 class="stats-title">Rata-rata Nilai</h6>
                            <h3 class="stats-number">85.5</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Statistics Cards -->

    <br>

    <!-- Start Materials Display -->
    <div class="container">
        <div class="bg-white mx-auto p-4" data-aos="fade-up" data-aos-duration="1400" style="border-radius: 15px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 6px 6px rgba(0, 0, 0, 0.05);">
            <div class="row">
                <div class="col-md-12 mt-1">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                        <div class="mb-2 mb-md-0 w-100 w-md-auto">
                            <h2 class="display-4 mobile-header" data-aos="fade-down" data-aos-duration="1400">Materi Pembelajaran</h2>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari materi..." aria-label="Cari materi">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="searchButton"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <select class="form-control" id="mapelFilter">
                                <option value="">Semua Mata Pelajaran</option>
                                <?php
                                $mapel_list = array_unique(array_map(function($item) {
                                    return $item->nama_mapel;
                                }, $materi));
                                foreach ($mapel_list as $mapel) : ?>
                                    <option value="<?= $mapel ?>"><?= $mapel ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div id="materiContainer">
                    <?php if (!empty($materi)): ?>
                        <div class="row">
                            <?php foreach ($materi as $item): ?>
                                <div class="col-lg-4 col-md-6 mb-4 materi-item" data-aos="fade-up" data-aos-duration="1000" 
                                     data-mapel="<?= $item->nama_mapel ?>"
                                     data-judul="<?= strtolower($item->nama_mapel) ?>"
                                     data-guru="<?= strtolower($item->nama_guru) ?>"
                                     data-deskripsi="<?= strtolower($item->deskripsi) ?>">
                                    <div class="card h-100 materi-card">
                                        <div class="card-header bg-transparent border-0 pt-3 pb-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge badge-primary"><?= $item->nama_mapel ?></span>
                                                <small class="text-muted"><i class="fa fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($item->tanggal_upload)) ?></small>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $item->nama_mapel ?></h5>
                                            <div class="teacher-info d-flex align-items-center mb-2">
                                                <i class="fa fa-user-circle mr-2 text-secondary"></i>
                                                <h6 class="card-subtitle mb-0 text-muted"><?= $item->nama_guru ?></h6>
                                            </div>
                                            <p class="card-text"><?= substr($item->deskripsi, 0, 100) ?>...</p>
                                            <div class="mt-3">
                                                <span class="badge badge-info"><i class="fa fa-clock mr-1"></i> <?= date('H:i', strtotime($item->tanggal_upload)) ?></span>
                                                <?php if ($item->file): ?>
                                                    <span class="badge badge-success"><i class="fa fa-file mr-1"></i> Ada Lampiran</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="text-muted small material-indicator"><i class="fa fa-book mr-1"></i> Materi</span>
                                                </div>
                                                <a href="<?= site_url('materi/belajar/' . $item->id_materi) ?>" class="btn btn-primary btn-view-material">
                                                    <i class="fa fa-arrow-right mr-1"></i> Lihat Materi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <img src="<?= base_url('assets/') ?>img/empty-state.svg" alt="No Materials" style="max-width: 200px;" class="mb-3">
                            <p class="lead">Belum ada materi untuk kelas Anda saat ini.</p>
                            <p class="text-muted">Silahkan cek kembali nanti atau hubungi guru Anda.</p>
                            <button class="btn btn-primary mt-3" onclick="location.reload()">
                                <i class="fa fa-sync-alt mr-1"></i> Refresh Halaman
                            </button>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Materials Display -->

    <br>

    <!-- Start Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        // Fungsi pencarian dan filter materi
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const mapelFilter = document.getElementById('mapelFilter');
            const materiItems = document.querySelectorAll('.materi-item');

            function filterMateri() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedMapel = mapelFilter.value.toLowerCase();

                materiItems.forEach(item => {
                    const judul = item.dataset.judul;
                    const guru = item.dataset.guru;
                    const deskripsi = item.dataset.deskripsi;
                    const mapel = item.dataset.mapel.toLowerCase();

                    const matchesSearch = judul.includes(searchTerm) || 
                                        guru.includes(searchTerm) || 
                                        deskripsi.includes(searchTerm);
                    const matchesMapel = !selectedMapel || mapel === selectedMapel;

                    item.style.display = matchesSearch && matchesMapel ? '' : 'none';
                });

                // Tampilkan pesan jika tidak ada hasil
                const visibleItems = document.querySelectorAll('.materi-item[style=""]');
                const materiContainer = document.getElementById('materiContainer');
                
                if (visibleItems.length === 0) {
                    materiContainer.innerHTML = `
                        <div class="text-center py-5">
                            <img src="<?= base_url('assets/') ?>img/empty-state.svg" alt="No Results" style="max-width: 200px;" class="mb-3">
                            <p class="lead">Tidak ada materi yang ditemukan.</p>
                            <p class="text-muted">Coba kata kunci pencarian atau filter yang berbeda.</p>
                            <button class="btn btn-primary mt-3" onclick="resetFilters()">
                                <i class="fa fa-undo mr-1"></i> Reset Filter
                            </button>
                        </div>
                    `;
                }
            }

            function resetFilters() {
                searchInput.value = '';
                mapelFilter.value = '';
                location.reload();
            }

            searchInput.addEventListener('input', filterMateri);
            mapelFilter.addEventListener('change', filterMateri);
        });
    </script>
    <!-- End Animate On Scroll -->

    <!-- jQuery dan Bootstrap JS untuk memperbaiki navbar-toggler -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hilangkan semua efek transisi yang mungkin menyebabkan masalah
            $('*').css({
                'transition': 'none',
                'animation': 'none'
            });
            
            // Fungsi reset toggle
            function resetToggle() {
                $('.navbar-collapse').removeClass('show');
                $('.navbar-collapse').removeClass('collapsing');
                $('.navbar-toggler').attr('aria-expanded', 'false');
            }
            
            // Listener untuk toggle
            $('.navbar-toggler').on('click', function() {
                // Mencegah event default Bootstrap
                event.preventDefault();
                event.stopPropagation();
                
                // Toggle manual
                if ($('#navbarSupportedContent').hasClass('show')) {
                    $('#navbarSupportedContent').removeClass('show');
                } else {
                    $('#navbarSupportedContent').addClass('show');
                }
            });
            
            // Reset saat scroll untuk menghindari bug
            $(window).on('scroll', function() {
                resetToggle();
            });
            
            // Reset saat klik di luar navbar
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.navbar').length) {
                    resetToggle();
                }
            });
        });
    </script>
</body>

</html>