<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Edit Soal Pilihan Ganda</h2>
                <hr>
                <a href="<?= base_url('guru/soal_pilihan_ganda') ?>" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <?php if ($this->session->flashdata('error_soal_update')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_soal_update') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <?= validation_errors() ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <?= form_open('guru/edit_soal_pilihan_ganda/' . $soal->id_soal, ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        <div class="mb-3">
                            <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" id="id_mapel" name="id_mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                <?php if (!empty($mapel)): ?>
                                    <?php foreach ($mapel as $m): ?>
                                        <option value="<?= $m['id_mapel'] ?>" <?= set_select('id_mapel', $m['id_mapel'], ($soal->id_mapel == $m['id_mapel'])) ?>><?= $m['nama_mapel'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Mata pelajaran harus dipilih</div>
                            <?= form_error('id_mapel', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="id_tugas" class="form-label">Tugas Terkait (ID Tugas)</label>
                            <input type="text" class="form-control" id="id_tugas" name="id_tugas" value="<?= set_value('id_tugas', $soal->id_tugas) ?>" placeholder="Kosongkan jika tidak terkait tugas">
                            <div class="form-text text-muted">Masukkan ID tugas jika soal ini bagian dari tugas.</div>
                            <?= form_error('id_tugas', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="5" required><?= set_value('pertanyaan', $soal->pertanyaan) ?></textarea>
                            <div class="invalid-feedback">Pertanyaan harus diisi</div>
                            <?= form_error('pertanyaan', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="pilihan_a" class="form-label">Pilihan A</label>
                            <input type="text" class="form-control" id="pilihan_a" name="pilihan_a" value="<?= set_value('pilihan_a', $soal->pilihan_a) ?>" required>
                            <div class="invalid-feedback">Pilihan A harus diisi</div>
                            <?= form_error('pilihan_a', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="pilihan_b" class="form-label">Pilihan B</label>
                            <input type="text" class="form-control" id="pilihan_b" name="pilihan_b" value="<?= set_value('pilihan_b', $soal->pilihan_b) ?>" required>
                            <div class="invalid-feedback">Pilihan B harus diisi</div>
                            <?= form_error('pilihan_b', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="pilihan_c" class="form-label">Pilihan C</label>
                            <input type="text" class="form-control" id="pilihan_c" name="pilihan_c" value="<?= set_value('pilihan_c', $soal->pilihan_c) ?>" required>
                            <div class="invalid-feedback">Pilihan C harus diisi</div>
                            <?= form_error('pilihan_c', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="pilihan_d" class="form-label">Pilihan D</label>
                            <input type="text" class="form-control" id="pilihan_d" name="pilihan_d" value="<?= set_value('pilihan_d', $soal->pilihan_d) ?>" required>
                            <div class="invalid-feedback">Pilihan D harus diisi</div>
                            <?= form_error('pilihan_d', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <div class="mb-3">
                            <label for="kunci_jawaban" class="form-label">Kunci Jawaban</label>
                            <select class="form-select" id="kunci_jawaban" name="kunci_jawaban" required>
                                <option value="">Pilih Kunci Jawaban</option>
                                <option value="A" <?= set_select('kunci_jawaban', 'A', ($soal->kunci_jawaban == 'A')) ?>>A</option>
                                <option value="B" <?= set_select('kunci_jawaban', 'B', ($soal->kunci_jawaban == 'B')) ?>>B</option>
                                <option value="C" <?= set_select('kunci_jawaban', 'C', ($soal->kunci_jawaban == 'C')) ?>>C</option>
                                <option value="D" <?= set_select('kunci_jawaban', 'D', ($soal->kunci_jawaban == 'D')) ?>>D</option>
                            </select>
                            <div class="invalid-feedback">Kunci Jawaban harus dipilih</div>
                            <?= form_error('kunci_jawaban', '<small class="text-danger">', '</small>') ?>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>stisla-assets/js/stisla.js"></script>
<!-- Template JS File -->
<script src="<?= base_url('assets/') ?>stisla-assets/js/scripts.js"></script>
<script src="<?= base_url('assets/') ?>stisla-assets/js/custom.js"></script>
<script>
    // Bootstrap 4 validation script (Stisla template typically uses this)
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script> 