<h2>Edit Schedule</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('jadwal/edit/' . $jadwal->id); ?>

    <div>
        <label for="kelas_id">Kelas:</label>
        <input type="text" name="kelas_id" id="kelas_id" value="<?= set_value('kelas_id', $jadwal->kelas_id) ?>" required>
         <?php // In a real application, this should be a dropdown populated from the kelas table ?>
    </div>

    <div>
        <label for="nip">NIP Guru:</label>
        <input type="text" name="nip" id="nip" value="<?= set_value('nip', $jadwal->nip) ?>" required>
         <?php // In a real application, this should be a dropdown populated from the guru table ?>
    </div>

    <div>
        <label for="materi_id">Materi:</label>
        <input type="text" name="materi_id" id="materi_id" value="<?= set_value('materi_id', $jadwal->materi_id) ?>" required>
        <?php // In a real application, this should be a dropdown populated from the materi table ?>
    </div>

    <div>
        <label for="hari">Hari:</label>
        <select name="hari" id="hari" required>
            <option value="">Select Day</option>
            <option value="Senin" <?= set_select('hari', 'Senin', $jadwal->hari == 'Senin') ?>>Senin</option>
            <option value="Selasa" <?= set_select('hari', 'Selasa', $jadwal->hari == 'Selasa') ?>>Selasa</option>
            <option value="Rabu" <?= set_select('hari', 'Rabu', $jadwal->hari == 'Rabu') ?>>Rabu</option>
            <option value="Kamis" <?= set_select('hari', 'Kamis', $jadwal->hari == 'Kamis') ?>>Kamis</option>
            <option value="Jumat" <?= set_select('hari', 'Jumat', $jadwal->hari == 'Jumat') ?>>Jumat</option>
            <option value="Sabtu" <?= set_select('hari', 'Sabtu', $jadwal->hari == 'Sabtu') ?>>Sabtu</option>
        </select>
    </div>

    <div>
        <label for="jam_mulai">Jam Mulai:</label>
        <input type="time" name="jam_mulai" id="jam_mulai" value="<?= set_value('jam_mulai', $jadwal->jam_mulai) ?>" required>
    </div>

    <div>
        <label for="jam_selesai">Jam Selesai:</label>
        <input type="time" name="jam_selesai" id="jam_selesai" value="<?= set_value('jam_selesai', $jadwal->jam_selesai) ?>" required>
    </div>

    <button type="submit">Update Schedule</button>

<?php echo form_close(); ?>

<a href="<?= base_url('jadwal') ?>">Back to Schedule List</a> 