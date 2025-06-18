<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah Jadwal</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Form Tambah Jadwal</h4>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/add_jadwal_process') ?>" method="post">
                      <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                          <option value="">-- Pilih Kelas --</option>
                          <?php foreach ($kelas_list as $kelas) : ?>
                            <option value="<?= $kelas->id_kelas ?>"><?= $kelas->nama_kelas ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nip">Guru</label>
                        <select class="form-control" id="nip" name="nip" required>
                          <option value="">-- Pilih Guru --</option>
                          <?php foreach ($guru_list as $guru) : ?>
                            <option value="<?= $guru->nip ?>"><?= $guru->nama_guru ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="id_materi">Mata Pelajaran</label>
                        <select class="form-control" id="id_materi" name="id_materi" required>
                          <option value="">-- Pilih Mata Pelajaran --</option>
                        </select>
                        <small id="id_materi_error" class="text-danger"></small>
                      </div>
                      <div class="form-group">
                        <label for="hari">Hari</label>
                        <select class="form-control" id="hari" name="hari" required>
                          <option value="">-- Pilih Hari --</option>
                          <option value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                          <option value="Jumat">Jumat</option>
                          <option value="Sabtu">Sabtu</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                      </div>
                      <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#nip').change(function() {
        var nip = $(this).val();
        console.log('Selected NIP:', nip); // Debug log
        
        if(nip) {
            $.ajax({
                url: '<?= base_url("admin/get_mapel_by_guru") ?>',
                type: 'POST',
                data: {nip: nip},
                dataType: 'json',
                success: function(data) {
                    console.log('Received data:', data); // Debug log
                    $('#id_materi').empty();
                    $('#id_materi').append('<option value="">-- Pilih Mata Pelajaran --</option>');
                    if(data && data.length > 0) {
                        $.each(data, function(key, value) {
                            $('#id_materi').append('<option value="' + value.id_mapel + '">' + value.nama_mapel + '</option>');
                        });
                    } else {
                        $('#id_materi_error').text('Tidak ada mata pelajaran untuk guru ini');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax error:', error); // Debug log
                    $('#id_materi_error').text('Terjadi kesalahan saat mengambil data mata pelajaran');
                }
            });
        } else {
            $('#id_materi').empty();
            $('#id_materi').append('<option value="">-- Pilih Mata Pelajaran --</option>');
            $('#id_materi_error').text('');
        }
    });
});
</script> 