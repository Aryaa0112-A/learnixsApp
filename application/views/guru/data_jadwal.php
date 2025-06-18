<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Jadwal Saya</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Jadwal Mata Pelajaran Saya</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach ($jadwal as $jdw) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $jdw->nama_kelas ?></td>
                                <td><?= $jdw->nama_mapel ?></td>
                                <td><?= $jdw->hari ?></td>
                                <td><?= $jdw->jam_mulai ?></td>
                                <td><?= $jdw->jam_selesai ?></td>
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