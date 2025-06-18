<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <title>Belajar - <?= $detail->nama_mapel ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/materi_style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>

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
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= base_url('user') ?>">
                                    <i class="fa fa-book-open mr-1"></i> Materi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('user/tugas') ?>">
                                    <i class="fa fa-tasks mr-1"></i> Tugas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('user/jadwal') ?>">
                                    <i class="fa fa-calendar mr-1"></i> Jadwal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="<?= base_url('welcome/logout') ?>">
                                    <i class="fa fa-sign-out-alt mr-1"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Navigation Bar -->


    <!-- Start Greeting Cards -->
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <div class="col-md-12 mt-1 ml-4">
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">
                        Selamat Belajar !
                    </h1>
                    <h4 data-aos="fade-down" data-aos-duration="1700">
                        <?php
                        $data['user'] = $this->db->get_where('siswa', ['email' =>
                            $this->session->userdata('email')])->row_array();
                        echo $data['user']['nama'];
                        ?> - Siswa Learnix's
                    </h4>
                    <p><?= $detail->nama_mapel ?> - Kelas <?= $detail->kelas ?></p>
                    <hr align="left" width="600;">
                    <p style="line-height: 3px;">Kita akan mempelajari tentang</p>
                    <p class="font-weight-bold mt--5">
                        <?= substr($detail->deskripsi, 0, 120); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Greeting Cards -->


    <!-- Start Video Player -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <?php if ($detail->file) : ?>
                    <?php
                    $file_path = base_url('assets/materi_file/' . $detail->file);
                    $file_extension = pathinfo($detail->file, PATHINFO_EXTENSION);
                    ?>

                    <?php if (in_array($file_extension, ['mp4', 'mkv', 'mov'])) : ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fa fa-play-circle"></i> Video Pembelajaran</h5>
                            </div>
                            <div class="card-body p-0">
                                <video class="w-100" controls>
                                    <source src="<?= $file_path ?>" type="video/<?= $file_extension ?>">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            </div>
                        </div>
                    <?php elseif (in_array($file_extension, ['pdf'])) : ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-danger text-white">
                                <h5 class="mb-0"><i class="fa fa-file-pdf"></i> Dokumen PDF</h5>
                            </div>
                            <div class="card-body p-0">
                                <iframe src="<?= $file_path ?>" class="w-100" style="height: 600px;" frameborder="0"></iframe>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0"><i class="fa fa-file"></i> File Materi</h5>
                            </div>
                            <div class="card-body text-center">
                                <p class="mb-3">File tidak dapat ditampilkan langsung. Silakan download untuk membukanya.</p>
                                <a href="<?= $file_path ?>" class="btn btn-primary btn-lg" download>
                                    <i class="fa fa-download"></i> Download File
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="alert alert-warning" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> Dokumen materi tidak tersedia atau file tidak ditemukan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End Video Player -->
    <!-- Start Deskripsi Materi -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 w-150 mb-4">
                <div class="card materi border-0">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="teacher-avatar mr-3">
                                <i class="fa fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <div>
                                <h1 class="card-title display-4 mb-0"><?= $detail->nama_guru; ?></h1>
                                <p class="text-muted mb-0">Pengajar <?= $detail->nama_mapel; ?></p>
                            </div>
                        </div>
                        <hr style="background-color: white;">
                        <h5 class="card-text mb-3"><?= $detail->nama_mapel; ?></h5>
                        <div class="card-text">
                            <h6 class="mb-2">Deskripsi Materi:</h6>
                            <p class="mb-0"><?= nl2br($detail->deskripsi); ?></p>
                        </div>
                        <div class="mt-4">
                            <a href="<?= base_url('user') ?>" class="btn btn-secondary">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali ke Daftar Materi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Deskripsi Materi -->

    <!-- Start Diskusi Section -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-comments"></i> Diskusi Materi</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= $this->session->flashdata('error') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Form untuk mengirim pesan -->
                        <form action="<?= base_url('diskusi/tambah') ?>" method="POST">
                            <input type="hidden" name="id_materi" value="<?= $detail->id_materi ?>">
                            <div class="form-group">
                                <textarea class="form-control" name="pesan" rows="3" placeholder="Tulis pertanyaan atau komentar Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Kirim Pesan
                            </button>
                        </form>

                        <hr>

                        <!-- Daftar pesan -->
                        <div class="chat-container">
                            <?php 
                            foreach ($diskusi as $d) : 
                            ?>
                                <div class="chat-message <?= (isset($user['id_siswa']) && $d->id_siswa == $user['id_siswa']) || (isset($user['nip']) && $d->nip == $user['nip']) ? 'chat-message-right' : 'chat-message-left' ?>">
                                    <div class="chat-message-content">
                                        <div class="chat-message-header">
                                            <strong>
                                                <?= $d->nama ?? $d->nama_guru ?>
                                            </strong>
                                            <small class="text-muted">
                                                <?= date('d M Y H:i', strtotime($d->tanggal_kirim)) ?>
                                            </small>
                                        </div>
                                        <div class="chat-message-body">
                                            <?= $d->pesan ?>
                                        </div>
                                        <?php if ((isset($user['id_siswa']) && $d->id_siswa == $user['id_siswa']) || (isset($user['nip']) && $d->nip == $user['nip'])) : ?>
                                            <div class="chat-message-footer">
                                                <a href="<?= base_url('diskusi/hapus/' . $d->id_diskusi . '/' . $detail->id_materi) ?>" class="text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Diskusi Section -->

    <style>
    .chat-container {
        max-height: 400px;
        overflow-y: auto;
        padding: 20px;
    }

    .chat-message {
        margin-bottom: 20px;
        display: flex;
    }

    .chat-message-left {
        justify-content: flex-start;
    }

    .chat-message-right {
        justify-content: flex-end;
    }

    .chat-message-content {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 10px;
        background-color: #f8f9fa;
    }

    .chat-message-right .chat-message-content {
        background-color: #007bff;
        color: white;
    }

    .chat-message-header {
        margin-bottom: 5px;
    }

    .chat-message-right .chat-message-header strong {
        color: white;
    }

    .chat-message-right .chat-message-header small {
        color: rgba(255, 255, 255, 0.8);
    }

    .chat-message-body {
        word-wrap: break-word;
    }

    .chat-message-footer {
        margin-top: 5px;
        text-align: right;
    }

    .chat-message-right .chat-message-footer a {
        color: rgba(255, 255, 255, 0.8);
    }

    .chat-message-right .chat-message-footer a:hover {
        color: white;
    }
    </style>

    <br>


    <!-- Start Disqus Comment -->
   <!--  <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card komen w-150 border-0">
                    <div class="card-body p-5" style="font-family: 'Poppins', sans-serif !important;">
                        <h1 style="color: black; font-size:44px !important;">Apa komentarmu ?</h1>
                        <br>
                        <?php echo $disqus ?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Start Disqus Comment -->


    <br>
    <br>
    <br>


    <!-- Start Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- End Animate On Scroll -->

    <!-- Optional JavaScript -->
    <script src="<?= base_url('assets/') ?>js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/popper.js"></script>
    <script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/stellar.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/isotope/isotope-min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('assets/') ?>js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.counterup.js"></script>
    <script src="<?= base_url('assets/') ?>js/mail-script.js"></script>
    <script src="<?= base_url('assets/') ?>js/theme.js"></script>
</body>

</html>
    <!-- End Animate On Scroll -->