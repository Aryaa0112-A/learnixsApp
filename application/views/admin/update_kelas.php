            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="card card-success">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="color:black; font-size: 50px;">
                                Update Data Kelas</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan isi data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('admin/kelas_edit') ?>">

                                <div class="form-group">
                                    <label for="id_kelas">ID Kelas</label>
                                    <input readonly id="id_kelas" type="text" class="form-control" value="<?= $kelas_data->id_kelas ?>" name="id_kelas">
                                    <?= form_error('id_kelas', '<small class="text-danger">', '</small>'); ?>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kelas">Nama Kelas</label>
                                    <input id="kelas" type="text" value="<?= $kelas_data->nama_kelas ?>" class="form-control" name="kelas">
                                    <?= form_error('kelas', '<small class="text-danger">', '</small>'); ?>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Update data ⭢
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
