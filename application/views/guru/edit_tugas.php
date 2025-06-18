<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Tugas</h1>
        </div>
        <div class="card">
            <div class="card-body"> 
                <form method="POST" action="<?= base_url('guru/edit_tugas/' . $detail->id_tugas) ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul_tugas">Judul Tugas</label>
                        <input type="text" name="judul_tugas" id="judul_tugas" class="form-control" value="<?= set_value('judul_tugas', $detail->judul_tugas) ?>" required>
                        <?= form_error('judul_tugas', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_mapel">Mata Pelajaran</label>
                        <select name="id_mapel" id="id_mapel" class="form-control" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            <?php foreach ($mapel as $m) : ?>
                                <option value="<?= $m['id_mapel'] ?>" <?= set_select('id_mapel', $m['id_mapel'], $detail->id_mapel == $m['id_mapel']) ?>><?= $m['nama_mapel'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_mapel', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                     <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelas_list as $k) : ?>
                                <option value="<?= $k->nama_kelas ?>" <?= set_select('kelas', $k->nama_kelas, $detail->kelas == $k->nama_kelas) ?>><?= $k->nama_kelas ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kelas', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="deadline_date">Tanggal Deadline</label>
                        <input type="date" name="deadline_date" id="deadline_date" class="form-control" value="<?= set_value('deadline_date', date('Y-m-d', strtotime($detail->deadline))) ?>" required>
                        <?= form_error('deadline_date', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="deadline_time">Waktu Deadline</label>
                         <input type="time" name="deadline_time" id="deadline_time" class="form-control" value="<?= set_value('deadline_time', date('H:i', strtotime($detail->deadline))) ?>" required>
                        <?= form_error('deadline_time', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= set_value('deskripsi', $detail->deskripsi) ?></textarea>
                        <?= form_error('deskripsi', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="file_tugas">File Tugas (Optional)</label>
                        <input type="file" name="file_tugas" id="file_tugas" class="form-control-file">
                         <?php if (!empty($detail->file_tugas)) : ?>
                             <p class="form-text">Current file: <?= $detail->file_tugas ?></p>
                             <input type="hidden" name="old_file_tugas" value="<?= $detail->file_tugas ?>">
                         <?php endif; ?>
                         <?= form_error('file_tugas', '<small class="text-danger"> ', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Tugas</button>
                    <a href="<?= base_url('guru/tugas') ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div> 