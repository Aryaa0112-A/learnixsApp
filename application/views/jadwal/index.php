<h2>Schedule List</h2>

<a href="<?= base_url('jadwal/add') ?>">Add New Schedule</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kelas</th>
            <th>Guru</th>
            <th>Materi</th>
            <th>Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jadwal as $item): ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->nama_kelas ?></td>
            <td><?= $item->nama_guru ?></td>
            <td><?= $item->judul_materi ?></td>
            <td><?= $item->hari ?></td>
            <td><?= $item->jam_mulai ?></td>
            <td><?= $item->jam_selesai ?></td>
            <td>
                <a href="<?= base_url('jadwal/detail/' . $item->id) ?>">Detail</a>
                <a href="<?= base_url('jadwal/edit/' . $item->id) ?>">Edit</a>
                <a href="<?= base_url('jadwal/delete/' . $item->id) ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 