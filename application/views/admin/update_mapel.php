<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Edit Mata Pelajaran: <?= $mapel_data->nama_mapel ?></h2>
                <hr>

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

                <?= form_open('admin/update_mapel/' . $mapel_data->id_mapel, ['class' => 'needs-validation', 'novalidate' => '']) ?>
                    <input type="hidden" name="id_mapel" value="<?= $mapel_data->id_mapel ?>">

                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="<?= set_value('nama_mapel', $mapel_data->nama_mapel) ?>" required>
                        <div class="invalid-feedback">Nama mata pelajaran harus diisi</div>
                        <?= form_error('nama_mapel', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="mb-3">
                        <label for="kode_mapel" class="form-label">Kode Mata Pelajaran</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" value="<?= set_value('kode_mapel', $mapel_data->kode_mapel) ?>" required>
                        <div class="invalid-feedback">Kode mata pelajaran harus diisi</div>
                         <?= form_error('kode_mapel', '<small class="text-danger">', '</small>') ?>
                    </div>

                     <div class="mb-3">
                        <label for="nip_guru" class="form-label">Guru Pengampu</label>
                        <select class="form-select" id="nip_guru" name="nip_guru">
                            <option value="">-- Pilih Guru --</option>
                            <?php if (!empty($guru_list)): ?>
                                <?php foreach ($guru_list as $guru): ?>
                                    <option value="<?= $guru->nip ?>" <?= set_select('nip_guru', $guru->nip, $mapel_data->id_mapel == $guru->id_mapel) ?>><?= $guru->nama_guru ?> (<?= $guru->nip ?>)</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <div class="invalid-feedback">Pilih guru pengampu jika ada.</div>
                    </div>

                    <!-- Add other mapel input fields here if needed -->

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>

                    <a href="<?= base_url('admin/data_mapel') ?>" class="btn btn-secondary">Batal</a>

                <?= form_close() ?>

            </div>
        </div>
    </section>
</div> 