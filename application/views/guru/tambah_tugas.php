<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Data Tugas Siswa Learnix's Education</h2>
                <hr>
                <p class="card-text">Jumlah tugas anda di Learnix's Education sekarang adalah
                    <span class="font-weight-bold" style="color:black;">
                        <?php echo $this->db->count_all('tugas'); ?> Tugas.
                    </span>
                </p>
                <a href="<?= base_url('guru/tugas') ?>" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Kembali
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

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <?= form_open_multipart('guru/tambah_tugas', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        <div class="mb-3">
                            <label for="judul_tugas" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" value="<?= set_value('judul_tugas') ?>" required>
                            <div class="invalid-feedback">Judul tugas harus diisi</div>
                            <?= form_error('judul_tugas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3"> 
                            <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" id="id_mapel" name="id_mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                <?php if (!empty($mapel)): ?>
                                    <?php foreach ($mapel as $m): ?>
                                        <option value="<?= $m['id_mapel'] ?>" <?= set_select('id_mapel', $m['id_mapel']) ?>><?= $m['nama_mapel'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Mata pelajaran harus dipilih</div>
                            <?= form_error('id_mapel', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                <?php if (!empty($kelas_list)): ?>
                                    <?php foreach ($kelas_list as $k): ?>
                                        <option value="<?= $k->nama_kelas ?>" <?= set_select('kelas', $k->nama_kelas) ?>><?= $k->nama_kelas ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Kelas harus dipilih</div>
                            <?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="deadline_date" name="deadline_date" value="<?= set_value('deadline_date') ?>" required>
                                    <div class="invalid-feedback">Tanggal deadline harus diisi</div>
                                    <?= form_error('deadline_date', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control" id="deadline_time" name="deadline_time" value="<?= set_value('deadline_time') ?>" required>
                                    <div class="invalid-feedback">Waktu deadline harus diisi</div>
                                    <?= form_error('deadline_time', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required><?= set_value('deskripsi') ?></textarea>
                            <div class="invalid-feedback">Deskripsi tugas harus diisi</div>
                            <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="file_tugas" class="form-label">File Tugas (Opsional)</label>
                            <input type="file" class="form-control" id="file_tugas" name="file_tugas" accept=".pdf,.doc,.docx,.zip,.rar,.jpg,.jpeg,.png">
                            <div class="form-text">Format yang didukung: PDF, DOC, DOCX, ZIP, RAR, JPG, JPEG, PNG (Max. 2MB)</div>
                            <div class="form-text text-danger" id="file-error"></div>
                            <?= form_error('file_tugas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

    // File size validation
    document.getElementById('file_tugas').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        const errorDiv = document.getElementById('file-error');
        
        if (file) {
            if (file.size > maxSize) {
                errorDiv.textContent = 'Ukuran file terlalu besar. Maksimal 2MB.';
                e.target.value = ''; // Clear the file input
            } else {
                errorDiv.textContent = '';
            }
        }
    });

    // Initialize datetime picker
    flatpickr("#deadline", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today"
    });
</script>

