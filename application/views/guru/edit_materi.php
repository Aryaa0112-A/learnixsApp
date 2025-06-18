<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="detail" class="card card-success">
            <div class="col-md-12 text-center">
                <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                    Edit Materi</p>
                <p style="line-height:-30px;margin-top:-20px;">Silahkan edit data yang diperlukan dibawah </p>
                <hr>
            </div>

            <div class="card-body">
                <?php if (isset($materi) && is_array($materi)) : ?>
                <form method="post" enctype="multipart/form-data" action="<?= base_url('guru/edit_materi/') . (isset($materi['id_materi']) ? $materi['id_materi'] : '') ?>">
                    <div class="form-group">
                        <label for="inputEmail4">Nama Guru</label>
                        <input required type="text" readonly name="nama_guru" value="<?= isset($materi['nama_guru']) ? $materi['nama_guru'] : '' ?>" class="form-control" id="inputEmail4">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail4">Nama Mata Pelajaran</label>
                        <input required type="text" readonly name="nama_mapel" value="<?= isset($materi['nama_mapel']) ? $materi['nama_mapel'] : '' ?>" class="form-control" id="inputEmail4">
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Upload File Materi Baru (Opsional)</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">File saat ini: <?= isset($materi['file']) ? $materi['file'] : 'Tidak ada file' ?></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi Materi</label>
                        <textarea class="form-control" required name="deskripsi" id="exampleFormControlTextarea1" rows="3"><?= isset($materi['deskripsi']) ? $materi['deskripsi'] : '' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Kelas</label>
                        <select required id="inputState" name="id_kelas" class="form-control">
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id_kelas'] ?>" <?= (isset($materi['id_kelas']) && $k['id_kelas'] == $materi['id_kelas']) ? 'selected' : '' ?>><?= $k['nama_kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            Update Materi ⭢
                        </button>
                    </div>
                </form>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        Data materi tidak ditemukan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content --> 