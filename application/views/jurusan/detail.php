<!-- ================Premium Banner Area ================= -->
<section class="premium_banner_area">
    <div class="banner_overlay"></div>
    <div class="banner_particles" id="banner-particles"></div>
    <div class="premium_banner_inner d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="premium_banner_content text-center">
                        <div class="banner_badge" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                            <span>Program Keahlian</span>
                        </div>
                        <h1 data-aos="fade-up" data-aos-duration="1200" data-aos-once="true"><?= $jurusan['nama'] ?></h1>
                        <div class="banner_divider" data-aos="fade-up" data-aos-duration="1300" data-aos-once="true"></div>
                        <div class="banner_breadcrumbs" data-aos="fade-up" data-aos-duration="1400" data-aos-once="true">
                            <a href="<?= base_url('welcome') ?>">Beranda</a>
                            <span class="breadcrumb-separator"><i class="fa fa-angle-right"></i></span>
                            <a href="<?= base_url('welcome/jurusan') ?>">Jurusan</a>
                            <span class="breadcrumb-separator"><i class="fa fa-angle-right"></i></span>
                            <span class="current-page"><?= $jurusan['nama'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================End Premium Banner Area ================= -->

<!-- ================Jurusan Detail Area ================= -->
<section class="course_details_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Jurusan Overview -->
                <div class="course_details_left mb-5">
                    <div class="main_image mb-4" data-aos="fade-up" data-aos-duration="1600">
                        <img class="img-fluid rounded" src="<?= base_url('assets/img/jurusan/'.$jurusan['gambar']) ?>" alt="<?= $jurusan['nama'] ?>">
                    </div>
                    
                    <div class="jurusan-overview mb-5" data-aos="fade-up" data-aos-duration="1700">
                        <h3 class="mb-4">Tentang Jurusan <?= $jurusan['nama'] ?></h3>
                        <p><?= $jurusan['deskripsi'] ?></p>
                        
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-graduation-hat"></i> Program Keahlian</h5>
                                    <p><?= $jurusan['nama'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-license"></i> Akreditasi</h5>
                                    <p><?= $jurusan['akreditasi'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-graduation-hat"></i> Kelas 10</h5>
                                    <p><?php 
                                        if($slug == 'multimedia') {
                                            echo 'Desain Komunikasi Visual (DKV)';
                                        } elseif($slug == 'otkp') {
                                            echo 'Manajemen Perkantoran (MP)';
                                        } else {
                                            echo 'Teknik Kendaraan Ringan (TKR)';
                                        }
                                    ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-graduation-hat"></i> Kelas 11-12</h5>
                                    <p><?php 
                                        if($slug == 'multimedia') {
                                            echo 'Multimedia (MM)';
                                        } elseif($slug == 'otkp') {
                                            echo 'Otomatisasi Tata Kelola Perkantoran (OTKP)';
                                        } else {
                                            echo 'Teknik Kendaraan Ringan Otomotif (TKRO)';
                                        }
                                    ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-users"></i> Jumlah Kelas</h5>
                                    <p><?php 
                                        if($slug == 'multimedia' || $slug == 'tkro') {
                                            echo '3 Kelas';
                                        } else {
                                            echo '2 Kelas';
                                        }
                                    ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="jurusan-info-item">
                                    <h5><i class="lnr lnr-apartment"></i> Fasilitas</h5>
                                    <p><?php 
                                        if($slug == 'multimedia') {
                                            echo '3 Studio';
                                        } elseif($slug == 'tkro') {
                                            echo '2 Bengkel';
                                        } else {
                                            echo '2 Lab';
                                        }
                                    ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Visi & Misi -->
                    <div class="jurusan-visi-misi mb-5" data-aos="fade-up" data-aos-duration="1800">
                        <h3 class="mb-4">Visi & Misi</h3>
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="lnr lnr-eye"></i> Visi</h5>
                            </div>
                            <div class="card-body">
                                <p><?= $jurusan['visi'] ?></p>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="lnr lnr-rocket"></i> Misi</h5>
                            </div>
                            <div class="card-body">
                                <ul class="misi-list">
                                    <?php foreach($jurusan['misi'] as $misi): ?>
                                        <li><?= $misi ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kompetensi -->
                    <div class="jurusan-kompetensi mb-5" data-aos="fade-up" data-aos-duration="1900">
                        <h3 class="mb-4">Kompetensi Keahlian</h3>
                        <div class="row">
                            <?php foreach($jurusan['kompetensi'] as $key => $kompetensi): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="kompetensi-item d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="lnr lnr-checkmark-circle"></i>
                                        </div>
                                        <div class="content">
                                            <h5><?= $kompetensi ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Prospek Kerja -->
                    <div class="jurusan-prospek mb-5" data-aos="fade-up" data-aos-duration="2000">
                        <h3 class="mb-4">Prospek Kerja</h3>
                        <div class="row">
                            <?php foreach($jurusan['prospek_kerja'] as $key => $prospek): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="prospek-item d-flex align-items-center">
                                        <div class="icon-box">
                                            <i class="lnr lnr-briefcase"></i>
                                        </div>
                                        <div class="content">
                                            <h5><?= $prospek ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="right_sidebar">
                    <!-- Fasilitas -->
                    <div class="widget fasilitas_widget mb-4" data-aos="fade-left" data-aos-duration="1700">
                        <h3 class="widget_title">Fasilitas Jurusan</h3>
                        <div class="fasilitas_content">
                            <ul>
                                <?php foreach($jurusan['fasilitas'] as $fasilitas): ?>
                                    <li>
                                        <i class="lnr lnr-checkmark-circle"></i>
                                        <span><?= $fasilitas ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Jurusan Lainnya -->
                    <div class="widget other_courses mb-4" data-aos="fade-left" data-aos-duration="1800">
                        <h3 class="widget_title">Jurusan Lainnya</h3>
                        <div class="other_courses_content">
                            <ul>
                                <?php if($slug != 'multimedia'): ?>
                                <li>
                                    <a href="<?= base_url('welcome/detail_jurusan/multimedia') ?>">
                                        <i class="fa fa-tv"></i>
                                        <span>Multimedia / DKV</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php if($slug != 'otkp'): ?>
                                <li>
                                    <a href="<?= base_url('welcome/detail_jurusan/otkp') ?>">
                                        <i class="fa fa-desktop"></i>
                                        <span>OTKP / MP</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php if($slug != 'tkro'): ?>
                                <li>
                                    <a href="<?= base_url('welcome/detail_jurusan/tkro') ?>">
                                        <i class="fa fa-car"></i>
                                        <span>TKRO / TKR</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <li>
                                    <a href="<?= base_url('welcome/jurusan') ?>">
                                        <i class="fa fa-list"></i>
                                        <span>Lihat Semua Jurusan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Kontak -->
                    <div class="widget daftar_widget" data-aos="fade-left" data-aos-duration="1900">
                        <div class="daftar_content p-4 rounded text-center">
                            <h4>Tertarik Dengan Jurusan Ini?</h4>
                            <p>Dapatkan informasi lengkap tentang pendaftaran dan program keahlian ini.</p>
                            <a href="<?= base_url('welcome/kontak') ?>" class="daftar-btn">
                                <i class="lnr lnr-envelope"></i> Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================End Jurusan Detail Area ================= -->

<!-- CSS khusus untuk halaman detail jurusan -->
<style>
    .jurusan-info-item {
        background: #f9f9ff;
        padding: 15px;
        border-radius: 12px;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 3px solid #0072bc;
    }
    
    .jurusan-info-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 114, 188, 0.1);
    }
    
    .jurusan-info-item h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #222;
        display: flex;
        align-items: center;
    }
    
    .jurusan-info-item h5 i {
        color: #0072bc;
        margin-right: 10px;
        font-size: 20px;
    }
    
    .jurusan-info-item p {
        margin-bottom: 0;
        color: #555;
        font-weight: 500;
    }
    
    .misi-list {
        padding-left: 20px;
        margin-bottom: 0;
    }
    
    .misi-list li {
        margin-bottom: 15px;
        position: relative;
        padding-left: 10px;
        color: #444;
        font-size: 15px;
        line-height: 1.6;
    }
    
    .misi-list li:last-child {
        margin-bottom: 0;
    }
    
    .misi-list li:before {
        content: "";
        position: absolute;
        left: -15px;
        top: 8px;
        width: 8px;
        height: 8px;
        background: #0072bc;
        border-radius: 50%;
    }
    
    .kompetensi-item, .prospek-item {
        background: #f9f9ff;
        padding: 18px;
        border-radius: 12px;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 3px solid #0072bc;
    }
    
    .kompetensi-item:hover, .prospek-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 114, 188, 0.1);
    }
    
    .icon-box {
        width: 45px;
        height: 45px;
        background: #0072bc;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 114, 188, 0.2);
    }
    
    .kompetensi-item:hover .icon-box, .prospek-item:hover .icon-box {
        transform: rotate(10deg);
        background: #005a94;
    }
    
    .icon-box i {
        color: #fff;
        font-size: 20px;
    }
    
    .content h5 {
        font-size: 16px;
        margin-bottom: 0;
        color: #222;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .kompetensi-item:hover .content h5, .prospek-item:hover .content h5 {
        color: #0072bc;
    }
    
    .widget {
        background: #f9f9ff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .widget:hover {
        box-shadow: 0 10px 30px rgba(0, 114, 188, 0.15);
        transform: translateY(-5px);
    }
    
    .widget_title {
        font-size: 18px;
        background: linear-gradient(135deg, #0072bc, #0091ea);
        color: #fff;
        padding: 18px 20px;
        margin-bottom: 0;
        position: relative;
    }
    
    .widget_title:after {
        content: "";
        position: absolute;
        left: 20px;
        bottom: 0;
        width: 40px;
        height: 3px;
        background: #fff;
    }
    
    .fasilitas_content, .other_courses_content {
        padding: 25px;
    }
    
    .fasilitas_content ul, .other_courses_content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .fasilitas_content ul li, .other_courses_content ul li {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.08);
        padding-bottom: 15px;
    }
    
    .fasilitas_content ul li:last-child, .other_courses_content ul li:last-child {
        margin-bottom: 0;
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .fasilitas_content ul li i, .other_courses_content ul li i {
        color: #0072bc;
        margin-right: 12px;
        font-size: 18px;
        width: 25px;
    }
    
    .other_courses_content ul li a {
        display: flex;
        align-items: center;
        color: #444;
        transition: all 0.3s ease;
        width: 100%;
        font-weight: 500;
    }
    
    .other_courses_content ul li a:hover {
        color: #0072bc;
        transform: translateX(5px);
    }
    
    .daftar_content {
        padding: 30px !important;
        background: linear-gradient(135deg, #0072bc, #0091ea);
        color: #fff;
        border-radius: 12px;
    }
    
    .daftar_content h4 {
        color: #fff;
        margin-bottom: 15px;
        font-size: 22px;
        font-weight: 700;
    }
    
    .daftar_content p {
        margin-bottom: 25px;
        font-size: 15px;
        line-height: 1.6;
    }
    
    .daftar-btn {
        display: inline-block;
        background: #fff;
        color: #0072bc;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.4s ease;
        font-size: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .daftar-btn:hover {
        background: #f9f9ff;
        color: #0072bc;
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
    }
    
    .daftar-btn i {
        margin-right: 8px;
    }
    
    .main_image {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .main_image img {
        transition: all 0.8s ease;
    }
    
    .main_image:hover img {
        transform: scale(1.05);
    }
    
    .jurusan-overview h3,
    .jurusan-visi-misi h3,
    .jurusan-kompetensi h3,
    .jurusan-prospek h3 {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 15px;
    }
    
    .jurusan-overview h3:after,
    .jurusan-visi-misi h3:after,
    .jurusan-kompetensi h3:after,
    .jurusan-prospek h3:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background: #0072bc;
    }
    
    .card-header.bg-primary {
        background: linear-gradient(135deg, #0072bc, #0091ea) !important;
    }
    
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }
    
    .card-body {
        padding: 25px;
    }
    
    /* Animasi */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .jurusan-overview, .jurusan-visi-misi, .jurusan-kompetensi, .jurusan-prospek {
        animation: fadeIn 0.8s ease-out forwards;
    }
    
    /* Responsivitas */
    @media (max-width: 991px) {
        .jurusan-info-item h5, .content h5 {
            font-size: 15px;
        }
        
        .icon-box {
            width: 40px;
            height: 40px;
        }
        
        .icon-box i {
            font-size: 18px;
        }
        
        .jurusan-overview h3,
        .jurusan-visi-misi h3,
        .jurusan-kompetensi h3,
        .jurusan-prospek h3 {
            font-size: 22px;
        }
        
        .daftar_content h4 {
            font-size: 20px;
        }
    }
    
    @media (max-width: 767px) {
        .jurusan-info-item, .kompetensi-item, .prospek-item {
            margin-bottom: 15px;
        }
        
        .jurusan-overview h3,
        .jurusan-visi-misi h3,
        .jurusan-kompetensi h3,
        .jurusan-prospek h3 {
            font-size: 20px;
        }
        
        .misi-list li {
            font-size: 14px;
        }
        
        .widget_title {
            font-size: 17px;
            padding: 15px;
        }
        
        .fasilitas_content, .other_courses_content {
            padding: 20px;
        }
        
        .daftar_content {
            padding: 25px !important;
        }
        
        .daftar_content h4 {
            font-size: 18px;
        }
        
        .daftar-btn {
            padding: 10px 25px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 480px) {
        .jurusan-info-item, .kompetensi-item, .prospek-item {
            padding: 15px;
        }
        
        .jurusan-overview h3,
        .jurusan-visi-misi h3,
        .jurusan-kompetensi h3,
        .jurusan-prospek h3 {
            font-size: 18px;
            padding-bottom: 12px;
        }
        
        .jurusan-overview h3:after,
        .jurusan-visi-misi h3:after,
        .jurusan-kompetensi h3:after,
        .jurusan-prospek h3:after {
            width: 50px;
            height: 2px;
        }
        
        .icon-box {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            margin-right: 10px;
        }
        
        .icon-box i {
            font-size: 16px;
        }
        
        .content h5 {
            font-size: 14px;
        }
        
        .widget_title {
            font-size: 16px;
            padding: 12px 15px;
        }
        
        .widget_title:after {
            width: 30px;
            height: 2px;
        }
        
        .fasilitas_content, .other_courses_content {
            padding: 15px;
        }
        
        .fasilitas_content ul li, .other_courses_content ul li {
            margin-bottom: 12px;
            padding-bottom: 12px;
        }
        
        .fasilitas_content ul li i, .other_courses_content ul li i {
            font-size: 16px;
            margin-right: 10px;
        }
        
        .daftar_content {
            padding: 20px !important;
        }
        
        .daftar_content h4 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        
        .daftar_content p {
            font-size: 13px;
            margin-bottom: 15px;
        }
        
        .daftar-btn {
            padding: 8px 20px;
            font-size: 13px;
        }
        
        /* Menonaktifkan animasi untuk performa */
        .jurusan-info-item:hover,
        .kompetensi-item:hover,
        .prospek-item:hover,
        .widget:hover,
        .other_courses_content ul li a:hover {
            transform: none;
        }
        
        .kompetensi-item:hover .icon-box, 
        .prospek-item:hover .icon-box {
            transform: none;
        }
    }
</style> 