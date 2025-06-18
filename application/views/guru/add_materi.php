            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="card card-success">
                        <div class="card-header">
                            <h4 style="color: black; font-size: 24px;">Tambah Materi</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Silahkan isi data data yang diperlukan dibawah</p>
                            <hr>
                            <form method="post" enctype="multipart/form-data" action="<?=base_url('guru/add_materi')?>">
                                <div class="form-group">
                                   <label for="nama_guru">Nama Guru</label>
                                    <input required type="text" readonly name="nama_guru" value="<?php
                                    echo isset($user['nama_guru']) ? $user['nama_guru'] : '';
                                    ?>" class="form-control" id="nama_guru">
                                </div>

                                <div class="form-group">
                                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                                    <input required type="text" readonly name="nama_mapel" value="<?php
                                    echo isset($user['nama_mapel']) ? $user['nama_mapel'] : '';
                                    ?>" class="form-control" id="nama_mapel">
                                </div>

                                <div class="form-group">
                                    <label for="inputGroupFile01">Upload File Materi Disini</label>
                                    <div class="input-group">
                                            <div class="custom-file">
                                                <input required type="file" name="file" required class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
                                        <label for="deskripsi">Deskripsi Materi</label>
                                        <textarea class="form-control" required name="deskripsi"
                                            id="deskripsi" rows="3"></textarea>
                                    </div>

                                <div class="form-group">
                                   <label for="kelas">Kelas</label>
                                        <select required id="kelas" name="id_kelas" class="form-control">
                                            <option value="">Pilih disini</option>
                                            <?php
                                            $kelas_list = $this->db->get('kelas')->result_array();
                                            foreach ($kelas_list as $k) :
                                            ?>
                                                <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Tambah Materi ⭢
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
