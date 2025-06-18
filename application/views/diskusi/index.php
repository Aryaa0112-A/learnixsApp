<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ruang Diskusi Materi</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Materi: <?= $materi->nama_mapel ?></h4>
                        <p class="text-muted"><?= $materi->deskripsi ?></p>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= $this->session->flashdata('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <?= $this->session->flashdata('error') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Form untuk mengirim pesan -->
                        <form action="<?= base_url('diskusi/tambah') ?>" method="POST">
                            <input type="hidden" name="id_materi" value="<?= $materi->id_materi ?>">
                            <div class="form-group">
                                <textarea class="form-control" name="pesan" rows="3" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                        </form>

                        <hr>

                        <!-- Daftar pesan -->
                        <div class="chat-container">
                            <?php foreach ($diskusi as $d) : ?>
                                <div class="chat-message <?= (isset($user['id_siswa']) && $d->id_siswa == $user['id_siswa']) || (isset($user['nip']) && $d->nip == $user['nip']) ? 'chat-message-right' : 'chat-message-left' ?>">
                                    <div class="chat-message-content">
                                        <div class="chat-message-header">
                                            <strong>
                                                <?= $d->nama ?? $d->nama_guru ?>
                                            </strong>
                                            <small class="text-muted">
                                                <?= date('d M Y H:i', strtotime($d->tanggal_kirim)) ?>
                                            </small>
                                        </div>
                                        <div class="chat-message-body">
                                            <?= $d->pesan ?>
                                        </div>
                                        <?php if ((isset($user['id_siswa']) && $d->id_siswa == $user['id_siswa']) || (isset($user['nip']) && $d->nip == $user['nip'])) : ?>
                                            <div class="chat-message-footer">
                                                <a href="<?= base_url('diskusi/hapus/' . $d->id_diskusi . '/' . $materi->id_materi) ?>" class="text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.chat-container {
    max-height: 500px;
    overflow-y: auto;
    padding: 20px;
}

.chat-message {
    margin-bottom: 20px;
    display: flex;
}

.chat-message-left {
    justify-content: flex-start;
}

.chat-message-right {
    justify-content: flex-end;
}

.chat-message-content {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 10px;
    background-color: #f8f9fa;
}

.chat-message-right .chat-message-content {
    background-color: #007bff;
    color: white;
}

.chat-message-header {
    margin-bottom: 5px;
}

.chat-message-right .chat-message-header strong {
    color: white;
}

.chat-message-right .chat-message-header small {
    color: rgba(255, 255, 255, 0.8);
}

.chat-message-body {
    word-wrap: break-word;
}

.chat-message-footer {
    margin-top: 5px;
    text-align: right;
}

.chat-message-right .chat-message-footer a {
    color: rgba(255, 255, 255, 0.8);
}

.chat-message-right .chat-message-footer a:hover {
    color: white;
}
</style> 