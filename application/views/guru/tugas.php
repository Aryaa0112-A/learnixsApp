<!-- Main Content -->
<div class="main-content">
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title" style="color: black;">Management Data Tugas Siswa Learnix's Education</h2>
                            <hr>
                            <p class="card-text">Jumlah tugas anda di Learnix's Education sekarang adalah
                            <span class="font-weight-bold" style="color:black;">
                                <?php echo $total_tugas; ?> Tugas.
                            </span></p>
                            <a href="<?= base_url('guru/tambah_tugas') ?>" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Tugas
                    </a>
                        </div>
                <?php if ($this->session->flashdata('success_tugas')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success_tugas') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error_tugas')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error_tugas') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success_tugas_delete')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success_tugas_delete') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error_tugas_delete')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error_tugas_delete') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success_tugas_update')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success_tugas_update') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error_tugas_update')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error_tugas_update') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Tugas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($tugas)) : ?>
                                        <?php $no = 1; foreach ($tugas as $t) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $t->judul_tugas ?></td>
                                                <td><?= $t->nama_mapel ?></td>
                                                <td><?= $t->kelas ?></td>
                                                <td><?= date('d-m-Y H:i', strtotime($t->deadline)) ?></td>
                                                <td>
                                                    <?php if (strtotime($t->deadline) < time()) : ?>
                                                        <span class="badge bg-danger">Selesai</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-success">Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('guru/detail_tugas/' . $t->id_tugas) ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Lihat Submission
                                                    </a>
                                                    <a href="<?= base_url('guru/edit_tugas/' . $t->id_tugas) ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $t->id_tugas ?>">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal<?= $t->id_tugas ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $t->id_tugas ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel<?= $t->id_tugas ?>">Konfirmasi Hapus</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus tugas "<?= $t->judul_tugas ?>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <a href="<?= base_url('guru/delete_tugas/' . $t->id_tugas) ?>" class="btn btn-danger">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada tugas yang tersedia</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 