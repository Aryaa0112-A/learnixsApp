<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Update Jadwal</h1>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Form Update Jadwal</h4>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('admin/jadwal_edit') ?>" method="post">
                      <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <input type="hidden" name="id_jadwal" value="<?= $jadwal_detail->id_jadwal ?>">
                        <select class="form-control" id="id_kelas" name="id_kelas" required>
                          <option value="">-- Pilih Kelas --</option>
                          <?php foreach ($kelas_list as $kelas) : ?>
                            <option value="<?= $kelas->id_kelas ?>" <?= ($kelas->id_kelas == $jadwal_detail->id_kelas) ? 'selected' : '' ?>><?= $kelas->nama_kelas ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nip">Guru</label>
                        <select class="form-control" id="nip" name="nip" required>
                          <option value="">-- Pilih Guru --</option>
                          <?php foreach ($guru_list as $guru) : ?>
                            <option value="<?= $guru->nip ?>" <?= ($guru->nip == $jadwal_detail->nip) ? 'selected' : '' ?>><?= $guru->nama_guru ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="id_materi">Mata Pelajaran</label>
                        <select class="form-control" id="id_materi" name="id_materi" required>
                          <option value="">-- Pilih Mata Pelajaran --</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="hari">Hari</label>
                        <input type="text" class="form-control" id="hari" name="hari" value="<?= $jadwal_detail->hari ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?= $jadwal_detail->jam_mulai ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?= $jadwal_detail->jam_selesai ?>" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
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
function loadMapelByGuru(nip, selected) {
    $('#id_materi').html('<option value="">-- Pilih Mata Pelajaran --</option>');
    if(nip) {
        $.ajax({
            url: '<?= base_url('admin/get_mapel_by_guru') ?>',
            type: 'POST',
            data: {nip: nip},
            dataType: 'json',
            success: function(data) {
                if(data.length > 0) {
                    $.each(data, function(i, mapel) {
                        var sel = (mapel.id_mapel == selected) ? 'selected' : '';
                        $('#id_materi').append('<option value="'+mapel.id_mapel+'" '+sel+'>'+mapel.nama_mapel+'</option>');
                    });
                }
            }
        });
    }
}

$('#nip').on('change', function() {
    loadMapelByGuru($(this).val(), null);
});
// Load mapel saat halaman pertama kali dibuka (untuk edit)
$(document).ready(function() {
    var nip = $('#nip').val();
    var selected = "<?= isset($jadwal_detail->id_mapel) ? $jadwal_detail->id_mapel : '' ?>";
    loadMapelByGuru(nip, selected);
});
</script> 