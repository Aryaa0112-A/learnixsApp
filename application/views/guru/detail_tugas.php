<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>guru Dashboard - Learn Education</title>
    <!-- General CSS Files -->
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>stisla-assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>stisla-assets/css/components.css">
</head>

<body>

    <!-- Start Sidebar -->
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class=" navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" style="margin-bottom:4px !important;" src="./assets/stisla-assets/img/avatar/avatar-2.png" class="rounded-circle mr-1 my-auto border-white">
                            <div class="d-sm-none d-lg-inline-block" style="font-size:15px;">Halo, 
                                <?php $data['user'] = $this->db->get_where('guru', ['email' => 
                                    $this->session->userdata('email')])->row_array();
                                    echo $data['user']['nama_guru'];
                               ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Guru - Learnix's</div>
                            <a href="<?= base_url('welcome/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand text-danger">
                        <div>
                            <a href="<?= base_url('guru') ?>" style="font-size: 21px;font-weight:900;font-family: 'Poppins', sans-serif;" class="text-success text-center"><i style="font-size: 30px;" class="fas fa-book"></i> Learnix's Education</a>
                        </div>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="<?= base_url('guru') ?>">LX <sup>3</sup></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header ">Dashboard</li>
                        <li class="nav-item dropdown active">
                            <a href="<?= base_url('guru') ?>" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Management Siswa</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                                <span>Siswa</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('guru/data_siswa') ?>">Data Siswa</a></li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Materi</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i>
                                <span>Materi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('guru/tambah_materi') ?>">Tambah Materi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Kelas</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i>
                                <span>Data Kelas</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('guru/data_kelas') ?>">Data Kelas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-header">Management Tugas</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-alt"></i>
                                <span>Tugas</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="<?= base_url('guru/tugas') ?>">Tambah Tugas</a>
                                </li>
                            </ul>
                        </li>
                </aside>
            </div>
            <!-- End Sidebar -->
             <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="">
                       </div>
                        <br>
                        <div class="col-md-12 bg-white p-3" id="detail" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px;">
                            <h1 class="font-weight-bold card-title text-center" style="color: black;">Detail Tugas </h1>
                            <p class="text-center" style="line-height: 5px;">
                            <hr>
                            <table style="width: 100%" class="container text-center">
                                <tbody>
                                    <tr style="border-bottom: 0.5px solid #6c757d;">
                                        <td><span class="font-weight-bold">Judul Tugas :</span></td>
                                        <td> <?= $detail->judul_tugas ?></td>
                                    </tr>
                                    <tr style="border-bottom: 0.5px solid #6c757d;">
                                        <td><span class="font-weight-bold">Mata Pelajaran :</span></td>
                                        <td> <?= $detail->nama_mapel ?></td>
                                    </tr>
                                    <tr style="border-bottom: 0.5px solid #6c757d;">
                                        <td><span class="font-weight-bold">Kelas :</span></td>
                                        <td> <?= $detail->kelas ?></td>
                                    </tr>
                                     <tr style="border-bottom: 0.5px solid #6c757d;">
                                        <td><span class="font-weight-bold">Deadline :</span></td>
                                        <td> <?= $detail->deadline ?></td>
                                    </tr>
                                    <tr style="border-bottom: 0.5px solid #6c757d;">
                                        <td><span class="font-weight-bold">Deskripsi :</span></td>
                                        <td> <?= $detail->deskripsi ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="font-weight:500px!important;font-size:18px;text-align:justify;" class="text-justify">
                            </p>

                            <h3 class="font-weight-bold card-title text-center" style="color: black; margin-top: 20px;">Daftar Pengumpulan Tugas</h3>
                            <hr>

                            <?php if (!empty($submissions)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Tanggal Submit</th>
                                                <th>Status</th>
                                                <th>File</th>
                                                <th>Nilai</th>
                                                <th>Komentar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($submissions as $submission): ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $submission->nama; ?></td>
                                                        <td><?php echo $submission->tanggal_submit; ?></td>
                                                        <td><?php echo $submission->status; ?></td>
                                                        <td>
                                                            <?php if (!empty($submission->file_submission)): ?>
                                                                <a href="<?php echo base_url('uploads/tugas/' . $submission->file_submission); ?>" download><?php echo $submission->file_submission; ?></a>
                                                            <?php else: ?>
                                                                Tidak ada file
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <form action="<?= base_url('guru/submit_grade_comment') ?>" method="post">
                                                                <input type="hidden" name="id_submission" value="<?= $submission->id_submission ?>">
                                                                <div class="d-flex flex-wrap align-items-center mb-2">
                                                                    <div class="form-group mr-2 mb-0" style="flex: 1;">
                                                                        <label for="nilai_<?= $submission->id_submission ?>" class="form-label visually-hidden">Nilai</label>
                                                                        <input type="number" class="form-control form-control-sm" id="nilai_<?= $submission->id_submission ?>" name="nilai" value="<?= $submission->nilai ?? '' ?>" min="0" max="100" placeholder="Nilai">
                                                                    </div>
                                                                    <div class="form-group mb-0" style="flex: 2;">
                                                                        <label for="komentar_<?= $submission->id_submission ?>" class="form-label visually-hidden">Komentar</label>
                                                                        <textarea class="form-control form-control-sm" id="komentar_<?= $submission->id_submission ?>" name="komentar" rows="1" placeholder="Komentar"><?= $submission->komentar ?? '' ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-center">Belum ada siswa yang mengumpulkan tugas ini.</p>
                            <?php endif; ?>

                            <div class="row mt-4">
                                <div class="col">
                                    <a href="<?= base_url('guru/tugas') ?>" class="btn btn-success">Kembali ke Daftar Tugas</a>
                                    <a href="<?= base_url('guru/edit_tugas/' . $detail->id_tugas) ?>" class="btn btn-warning">Edit Tugas</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- End Main Content -->

    <!-- Start Footer -->
    <footer class="main-footer">
        <div class="text-right">
            Copyright &copy; 2025 <div class="bullet"></div><a href="https://thedebuggers.vercel.app">The Debuggers</a>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url('assets/') ?>stisla-assets/js/stisla.js"></script>
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <!-- Template JS File -->
    <script src="<?= base_url('assets/') ?>stisla-assets/js/scripts.js"></script>
    <script src="<?= base_url('assets/') ?>stisla-assets/js/custom.js"></script>
</body>

</html>