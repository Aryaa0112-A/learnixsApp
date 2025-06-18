            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div id="detail" class="card card-success">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                                Pendaftaran Siswa</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="<?= base_url('admin/registration') ?>">
                                <div id="" class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input id="nama_lengkap" type="text" class="form-control" name="nama">
                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <!-- Add Nama Kelas field -->
                                <div class="form-group">
                                    <label for="id_kelas">Nama Kelas</label>
                                    <select id="id_kelas" class="form-control" name="id_kelas">
                                        <option value="">Pilih Kelas</option>
                                        <?php if (!empty($kelas_list)): ?>
                                            <?php foreach ($kelas_list as $kelas): ?>
                                                <option value="<?= $kelas->id_kelas ?>"><?= $kelas->nama_kelas ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <?= form_error('id_kelas', '<small class="text-danger">', '</small>'); ?>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="retype_password" class="d-block">Konfirmasi Password</label>
                                        <input id="retype_password" type="password" class="form-control" name="retype_password">
                                        <?= form_error('retype_password', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Daftar ⭢
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- End Main Content -->
