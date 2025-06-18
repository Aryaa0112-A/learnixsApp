<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Soal Pilihan Ganda Learnix's Education</h2>
                <hr>
                <p class="card-text">Jumlah soal pilihan ganda anda di Learnix's Education sekarang adalah
                <span class="font-weight-bold" style="color:black;">
                    <?php echo count($soal); ?> Soal.
                </span></p>
                <a href="<?= base_url('guru/tambah_soal_pilihan_ganda') ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Soal Pilihan Ganda
                </a>
            </div>

            <?php if ($this->session->flashdata('success_soal')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success_soal') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error_soal')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_soal') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_soal_delete')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success_soal_delete') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error_soal_delete')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_soal_delete') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success_soal_update')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success_soal_update') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error_soal_update')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_soal_update') ?>
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
                                    <th>Mata Pelajaran</th>
                                    <th>Pertanyaan</th>
                                    <th>Kunci Jawaban</th>
                                    <th>Dibuat Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($soal)) : ?>
                                    <?php $no = 1; foreach ($soal as $s) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $s->nama_mapel ?></td>
                                            <td><?= character_limiter($s->pertanyaan, 50) ?></td>
                                            <td><?= $s->kunci_jawaban ?></td>
                                            <td><?= !empty($s->created_at) ? date('d-m-Y H:i', strtotime($s->created_at)) : '-' ?></td>
                                            <td>
                                                <?php if(!empty($s->id_soal)): ?>
                                                    <a href="<?= base_url('guru/edit_soal_pilihan_ganda/' . $s->id_soal) ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                <?php else: ?>
                                                    <span class="btn btn-warning btn-sm disabled"><i class="fas fa-edit"></i> Edit</span>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSoalModal<?= $s->id_soal ?>">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteSoalModal<?= $s->id_soal ?>" tabindex="-1" aria-labelledby="deleteSoalModalLabel<?= $s->id_soal ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteSoalModalLabel<?= $s->id_soal ?>">Konfirmasi Hapus Soal</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus soal ini: "<?= character_limiter($s->pertanyaan, 100) ?>" ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <a href="<?= base_url('guru/delete_soal_pilihan_ganda/' . $s->id_soal) ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada soal pilihan ganda yang tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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