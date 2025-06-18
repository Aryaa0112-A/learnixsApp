<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Detail Kelas</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th width="200">ID Kelas</th>
                                <td><?php echo $kelas->id_kelas; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Kelas</th>
                                <td><?php echo $kelas->nama_kelas; ?></td>
                            </tr>
                            <tr>
                                <th>Daftar Siswa</th>
                                <td>
                                    <?php if (!empty($siswa_list)) : ?>
                                        <table class="table table-sm table-bordered mt-2">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach ($siswa_list as $siswa) : ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $siswa->nama; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else : ?>
                                        Belum ada siswa di kelas ini.
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Jadwal Kelas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($jadwal)) : ?>
                                        <?php foreach ($jadwal as $j) : ?>
                                            <tr>
                                                <td><?php echo $j->hari; ?></td>
                                                <td><?php echo $j->jam_mulai . ' - ' . $j->jam_selesai; ?></td>
                                                <td><?php echo $j->nama_mapel; ?></td>
                                                <td><?php echo $j->nama_guru; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada jadwal</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content --> 