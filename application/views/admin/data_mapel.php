<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Manajemen Data Mata Pelajaran Learnix's Education</h2>
                <hr>

                <a href="<?= base_url('admin/print_mapel') ?>" class="btn btn-danger mb-3">
                    <i class="fas fa-print"></i> Print Data Mata Pelajaran
                </a>

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

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Guru Pengampu</th>
                                <!-- Tambahkan kolom lain jika diperlukan -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($mapel_list)): ?>
                                <?php $no = 1; foreach ($mapel_list as $mapel): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $mapel->nama_mapel; ?></td>
                                        <td>
                                            <?php
                                                $guru_terkait = array_filter($guru_mapel, function($gm) use ($mapel) {
                                                    return $gm->nama_mapel == $mapel->nama_mapel;
                                                });
                                                if (!empty($guru_terkait)) {
                                                    $guru_names = array_map(function($gt) { return $gt->nama_guru; }, $guru_terkait);
                                                    echo implode(', ', $guru_names);
                                                } else {
                                                    echo 'Belum ada guru';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <!-- Tambahkan tombol aksi seperti edit atau hapus di sini -->
                                            <a href="<?= base_url('admin/detail_mapel/' . $mapel->id_mapel) ?>" class="btn btn-small btn-info">Lihat</a>
                                            <a href="<?= base_url('admin/update_mapel/' . $mapel->id_mapel) ?>" class="btn btn-small btn-primary">Edit</a>
                                            <a href="<?= base_url('admin/delete_mapel/' . $mapel->id_mapel) ?>" class="btn btn-small btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data mata pelajaran tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
