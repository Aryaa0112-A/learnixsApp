<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Tugas</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <?= form_open_multipart('guru/update_tugas', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        <input type="hidden" name="id_tugas" value="<?= $tugas->id_tugas ?>">
                        <input type="hidden" name="old_file_tugas" value="<?= $tugas->file_tugas ?>">

                        <div class="mb-3">
                            <label for="judul_tugas" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" value="<?= set_value('judul_tugas', $tugas->judul_tugas) ?>" required>
                            <div class="invalid-feedback">Judul tugas harus diisi</div>
                            <?= form_error('judul_tugas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3"> 
                            <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" id="id_mapel" name="id_mapel" required>
                                <?php if (!empty($mapel)): ?>
                                    <?php foreach ($mapel as $m): ?>
                                        <option value="<?= $m['id_mapel'] ?>" <?= set_select('id_mapel', $m['id_mapel'], $tugas->id_mapel == $m['id_mapel']) ?>><?= $m['nama_mapel'] ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Pilih Mata Pelajaran</option>
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
                                    <?php foreach ($kelas_list as $kelas): ?>
                                        <option value="<?= $kelas->nama_kelas ?>" <?= set_select('kelas', $kelas->nama_kelas, $tugas->kelas == $kelas->nama_kelas) ?>><?= $kelas->nama_kelas ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Kelas harus dipilih</div>
                             <?= form_error('kelas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <?php
                         $deadline_date = date('Y-m-d', strtotime($tugas->deadline));
                         $deadline_time = date('H:i', strtotime($tugas->deadline));
                        ?>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="deadline_date" name="deadline_date" value="<?= set_value('deadline_date', $deadline_date) ?>" required>
                                    <div class="invalid-feedback">Tanggal deadline harus diisi</div>
                                    <?= form_error('deadline_date', '<small class="text-danger">', '</small>') ?>
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control" id="deadline_time" name="deadline_time" value="<?= set_value('deadline_time', $deadline_time) ?>" required>
                                    <div class="invalid-feedback">Waktu deadline harus diisi</div>
                                    <?= form_error('deadline_time', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Tugas</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required><?= set_value('deskripsi', $tugas->deskripsi) ?></textarea>
                            <div class="invalid-feedback">Deskripsi tugas harus diisi</div>
                            <?= form_error('deskripsi', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="file_tugas" class="form-label">File Tugas (Opsional)</label>
                            <input type="file" class="form-control" id="file_tugas" name="file_tugas">
                            <?php if ($tugas->file_tugas): ?>
                                <p class="form-text">File saat ini: <?= $tugas->file_tugas ?></p>
                            <?php endif; ?>
                            <div class="form-text">Format yang didukung: PDF, DOC, DOCX, ZIP, RAR, JPG, JPEG, PNG (Max. 2MB)</div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                         <a href="<?= base_url('guru/tugas') ?>" class="btn btn-secondary">Batal</a>
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

    // Initialize datetime picker
    flatpickr("#deadline", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today"
    });
</script> 