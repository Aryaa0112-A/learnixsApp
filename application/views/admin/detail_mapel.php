<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Detail Mata Pelajaran: <?= $mapel_detail->nama_mapel ?></h2>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h4>Informasi Mata Pelajaran</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Mata Pelajaran</th>
                                <td><?= $mapel_detail->id_mapel ?></td>
                            </tr>
                            <tr>
                                <th>Nama Mata Pelajaran</th>
                                <td><?= $mapel_detail->nama_mapel ?></td>
                            </tr>
                            <tr>
                                <th>Kode Mata Pelajaran</th>
                                <td><?= $mapel_detail->kode_mapel ?></td>
                            </tr>
                            <?php if (isset($mapel_detail->created_at)): ?>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td><?= $mapel_detail->created_at ?></td>
                            </tr>
                            <?php endif; ?>
                             <?php if (isset($mapel_detail->updated_at)): ?>
                            <tr>
                                <th>Diperbarui Pada</th>
                                <td><?= $mapel_detail->updated_at ?></td>
                            </tr>
                            <?php endif; ?>
                            <!-- Add other mapel details here if available -->
                        </table>
                    </div>

                    <div class="col-md-6">
                         <h4>Guru Pengampu</h4>
                         <?php if (!empty($guru_terkait)): ?>
                             <table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>NIP</th>
                                         <th>Nama Guru</th>
                                         <!-- Add other guru details here if needed -->
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php foreach ($guru_terkait as $guru): ?>
                                     <tr>
                                         <td><?= $guru->nip ?></td>
                                         <td><?= $guru->nama_guru ?></td>
                                     </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
                         <?php else: ?>
                             <p>Belum ada guru yang mengampu mata pelajaran ini.</p>
                         <?php endif; ?>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('admin/data_mapel') ?>" class="btn btn-secondary">Kembali ke Daftar Mata Pelajaran</a>
                    <a href="<?= base_url('admin/update_mapel/' . $mapel_detail->id_mapel) ?>" class="btn btn-primary">Edit Mata Pelajaran</a>
                    <!-- Delete button could be added here, perhaps with a confirmation modal -->
                </div>

            </div>
        </div>
    </section>
</div> 