<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Submission Tugas: <?= $tugas->judul_tugas ?></h2>
                    <a href="<?= base_url('admin/tugas') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Mata Pelajaran:</strong> <?= $tugas->nama_mapel ?></p>
                                <p class="mb-2"><strong>Kelas:</strong> <?= $tugas->kelas ?></p>
                                <p class="mb-2"><strong>Deadline:</strong> <?= date('d-m-Y H:i', strtotime($tugas->deadline)) ?></p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Deskripsi Tugas:</h5>
                            <div class="border rounded p-3 bg-light">
                                <?= nl2br($tugas->deskripsi) ?>
                            </div>
                        </div>

                        <?php if ($tugas->file_tugas) : ?>
                            <div class="mb-4">
                                <h5>File Tugas:</h5>
                                <a href="<?= base_url('uploads/tugas/' . $tugas->file_tugas) ?>" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Download File
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">Daftar Submission</h4>
                            <div class="text-muted">
                                Total: <?= count($submissions) ?> submission
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="submissionsTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Submit</th>
                                        <th>Status</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($submissions)) : ?>
                                        <?php $no = 1; foreach ($submissions as $s) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $s->nama_siswa ?></td>
                                                <td><?= date('d-m-Y H:i', strtotime($s->tanggal_submit)) ?></td>
                                                <td>
                                                    <?php if (strtotime($s->tanggal_submit) > strtotime($tugas->deadline)) : ?>
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-success">Tepat Waktu</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($s->nilai) : ?>
                                                        <span class="badge <?= $s->nilai >= 60 ? 'bg-success' : 'bg-danger' ?>">
                                                            <?= $s->nilai ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <span class="text-muted">Belum dinilai</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal<?= $s->id_submission ?>">
                                                            <i class="fas fa-file"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nilaiModal<?= $s->id_submission ?>">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Preview Modal -->
                                                    <div class="modal fade" id="previewModal<?= $s->id_submission ?>" tabindex="-1" aria-labelledby="previewModalLabel<?= $s->id_submission ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="previewModalLabel<?= $s->id_submission ?>">Preview Submission</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <strong>Nama Siswa:</strong> <?= $s->nama_siswa ?>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <strong>Tanggal Submit:</strong> <?= date('d-m-Y H:i', strtotime($s->tanggal_submit)) ?>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <strong>File Submission:</strong>
                                                                        <div class="mt-2">
                                                                            <a href="<?= base_url('uploads/tugas/' . $s->file_submission) ?>" class="btn btn-primary" target="_blank">
                                                                                <i class="fas fa-download"></i> Download File
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($s->komentar) : ?>
                                                                        <div class="mb-3">
                                                                            <strong>Komentar:</strong>
                                                                            <div class="border rounded p-2 mt-1 bg-light">
                                                                                <?= nl2br($s->komentar) ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Nilai Modal -->
                                                    <div class="modal fade" id="nilaiModal<?= $s->id_submission ?>" tabindex="-1" aria-labelledby="nilaiModalLabel<?= $s->id_submission ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="nilaiModalLabel<?= $s->id_submission ?>">Nilai Tugas</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <?= form_open('admin/tugas/nilai_submission', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_submission" value="<?= $s->id_submission ?>">
                                                                        <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="nilai" class="form-label">Nilai</label>
                                                                            <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100" step="0.01" value="<?= $s->nilai ?>" required>
                                                                            <div class="invalid-feedback">
                                                                                Nilai harus diisi antara 0-100
                                                                            </div>
                                                                            <div class="form-text">Masukkan nilai antara 0-100</div>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="komentar" class="form-label">Komentar</label>
                                                                            <textarea class="form-control" id="komentar" name="komentar" rows="3"><?= $s->komentar ?></textarea>
                                                                            <div class="form-text">Opsional: Berikan komentar atau feedback untuk siswa</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                <?= form_close() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada submission</td>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // Initialize DataTable
        $(document).ready(function() {
            $('#submissionsTable').DataTable({
                "order": [[2, "desc"]], // Sort by submission date by default
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
                }
            });
        });
    </script>
</body>
</html> 