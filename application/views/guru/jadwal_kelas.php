<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Jadwal Kelas <?php echo $kelas->nama_kelas; ?></h2>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Nama Kelas</th>
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
                                                <td><?php echo $j->nama_kelas; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada jadwal</td>
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