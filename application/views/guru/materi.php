<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Materi Learnix's Education</h1>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Materi</h4>
                        </div>
                        <div class="card-body">
                            <?= $total_materi ?? 'N/A' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Daftar Materi</h4>
                <div class="card-header-action">
                    <a href="<?= base_url('guru/add_materi') ?>" class="btn btn-success">Tambah Materi <i class="fas fa-plus"></i></a>
                </div>
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

                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Guru</th>
                                <th>NIP Guru</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Tanggal Upload</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (isset($materi) && is_array($materi)) : // Check if $materi is set and is an array
                                foreach ($materi as $m) :
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $m['nama_guru']; ?></td>
                                        <td><?= $m['nip']; ?></td>
                                        <td><?= $m['nama_mapel']; ?></td>
                                        <td><?= $m['nama_kelas'] ?? 'N/A'; ?></td>
                                        <td><?= $m['deskripsi']; ?></td>
                                        <td>
                                            <?php if ($m['file']) : ?>
                                                <a href="<?= base_url('assets/materi_file/') . $m['file']; ?>" class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            <?php else : ?>
                                                <span class="badge badge-secondary">Tidak ada file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d F Y', strtotime($m['tanggal_upload'])); ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('diskusi/index/' . $m['id_materi']) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-comments"></i> Diskusi
                                            </a>
                                            <a href="<?= base_url('guru/edit_materi/' . $m['id_materi']) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= base_url('guru/hapus_materi/' . $m['id_materi']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else : // Handle case where $materi is not set or not an array
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data materi.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content -->
