<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Tambah Soal Pilihan Ganda</h2>
                <hr>
                <p class="card-text">Silakan tambahkan soal pilihan ganda untuk tugas yang telah dibuat.</p>

                <?= form_open('guru/tambah_soal_pilihan_ganda', ['class' => 'needs-validation', 'novalidate' => '', 'id' => 'formSoal']) ?>
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

                    <?php if(isset($id_tugas_otomatis) && $id_tugas_otomatis): ?>
                        <input type="hidden" id="id_tugas" name="id_tugas" value="<?= $id_tugas_otomatis ?>">
                    <?php else: ?>
                        <div class="mb-3">
                            <label for="id_tugas" class="form-label">Tugas Terkait</label>
                            <select class="form-select" id="id_tugas" name="id_tugas">
                                <option value="">Pilih Tugas (Opsional)</option>
                                <?php if (!empty($tugas_list)): ?>
                                    <?php foreach ($tugas_list as $t): ?>
                                        <option value="<?= $t->id_tugas ?>" <?= set_select('id_tugas', $t->id_tugas) ?>><?= $t->judul_tugas ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="form-text text-muted">Pilih tugas jika soal ini bagian dari tugas tertentu</div>
                        </div>
                    <?php endif; ?>

                    <div id="soalContainer">
                        <!-- Template soal pertama -->
                        <div class="soal-item card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Soal #1</h5>
                                <button type="button" class="btn btn-danger btn-sm hapus-soal" style="display: none;">
                                    <i class="fas fa-trash"></i> Hapus Soal
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Pertanyaan</label>
                                    <textarea class="form-control pertanyaan" name="soal[0][pertanyaan]" rows="3" required></textarea>
                                    <div class="invalid-feedback">Pertanyaan harus diisi</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilihan A</label>
                                    <input type="text" class="form-control" name="soal[0][pilihan_a]" required>
                                    <div class="invalid-feedback">Pilihan A harus diisi</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilihan B</label>
                                    <input type="text" class="form-control" name="soal[0][pilihan_b]" required>
                                    <div class="invalid-feedback">Pilihan B harus diisi</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilihan C</label>
                                    <input type="text" class="form-control" name="soal[0][pilihan_c]" required>
                                    <div class="invalid-feedback">Pilihan C harus diisi</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilihan D</label>
                                    <input type="text" class="form-control" name="soal[0][pilihan_d]" required>
                                    <div class="invalid-feedback">Pilihan D harus diisi</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kunci Jawaban</label>
                                    <select class="form-select" name="soal[0][kunci_jawaban]" required>
                                        <option value="">Pilih Kunci Jawaban</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                    <div class="invalid-feedback">Kunci jawaban harus dipilih</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-success" id="tambahSoal">
                            <i class="fas fa-plus"></i> Tambah Soal
                        </button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Semua Soal
                        </button>
                        <a href="<?= base_url('guru/soal_pilihan_ganda') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </section>
</div>

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

// Fungsi untuk menambah soal baru
document.getElementById('tambahSoal').addEventListener('click', function() {
    const container = document.getElementById('soalContainer');
    const soalCount = container.children.length;
    const newSoal = container.children[0].cloneNode(true);
    
    // Update nomor soal
    newSoal.querySelector('.card-header h5').textContent = `Soal #${soalCount + 1}`;
    
    // Update nama field
    const inputs = newSoal.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        if (input.name) {
            input.name = input.name.replace('[0]', `[${soalCount}]`);
            input.value = ''; // Clear values
        }
    });
    
    // Tampilkan tombol hapus untuk soal tambahan
    newSoal.querySelector('.hapus-soal').style.display = 'block';
    
    // Tambahkan event listener untuk tombol hapus
    newSoal.querySelector('.hapus-soal').addEventListener('click', function() {
        newSoal.remove();
        updateSoalNumbers();
    });
    
    container.appendChild(newSoal);
});

// Fungsi untuk update nomor soal
function updateSoalNumbers() {
    const container = document.getElementById('soalContainer');
    const soalItems = container.children;
    
    for (let i = 0; i < soalItems.length; i++) {
        soalItems[i].querySelector('.card-header h5').textContent = `Soal #${i + 1}`;
        
        // Update nama field
        const inputs = soalItems[i].querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            if (input.name) {
                input.name = input.name.replace(/\[\d+\]/, `[${i}]`);
            }
        });
    }
}
</script> 