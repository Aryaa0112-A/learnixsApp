<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Jadwal</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Jadwal</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach ($jadwal as $jdw) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $jdw->nama_kelas ?></td>
                                <td><?= $jdw->nama_guru ?></td>
                                <td><?= $jdw->nama_mapel ?></td>
                                <td><?= $jdw->hari ?></td>
                                <td><?= $jdw->jam_mulai ?></td>
                                <td><?= $jdw->jam_selesai ?></td>
                                <td>
                                    <a href="<?= base_url('admin/update_jadwal/' . $jdw->id_jadwal) ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/delete_jadwal/' . $jdw->id_jadwal) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this jadwal?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div> 