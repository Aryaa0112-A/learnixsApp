<h2>Schedule Details</h2>

<p><strong>ID:</strong> <?= $jadwal->id ?></p>
<p><strong>Kelas:</strong> <?= $jadwal->nama_kelas ?></p>
<p><strong>Guru:</strong> <?= $jadwal->nama_guru ?></p>
<p><strong>Materi:</strong> <?= $jadwal->judul_materi ?></p>
<p><strong>Hari:</strong> <?= $jadwal->hari ?></p>
<p><strong>Jam Mulai:</strong> <?= $jadwal->jam_mulai ?></p>
<p><strong>Jam Selesai:</strong> <?= $jadwal->jam_selesai ?></p>
<p><strong>Created At:</strong> <?= $jadwal->created_at ?></p>
<p><strong>Updated At:</strong> <?= $jadwal->updated_at ?></p>

<a href="<?= base_url('jadwal') ?>">Back to Schedule List</a> 