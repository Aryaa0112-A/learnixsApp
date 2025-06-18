<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Management Data Kelas Saya di Learnix's Education</h2>
                <hr>
                <p class="card-text">Berikut adalah daftar kelas yang Anda ajar:</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                    <div class="table-responsive">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Jumlah Siswa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kelas_list)) : ?>
                                    <?php foreach ($kelas_list as $kelas) : ?>
                                        <tr class="text-center">
                                            <td><?php echo $kelas->id_kelas; ?></td>
                                            <td><?php echo $kelas->nama_kelas; ?></td>
                                            <td><?php echo $kelas->jumlah_siswa ?? 0; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('kelas/detail/' . $kelas->id_kelas); ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                                <a href="<?php echo base_url('kelas/jadwal_kelas/' . $kelas->id_kelas); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-calendar"></i> Jadwal
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data kelas</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- End Main Content --> 