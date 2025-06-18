<!--================ Start Footer Area Premium =================-->
<footer class="footer-area premium-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-brand-container">
                        <div class="footer-logo">
                            <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo SMK Teknologi Pilar Bangsa">
                            <div class="footer-brand-text">
                                <h3>SMK Teknologi Pilar Bangsa</h3>
                                <p>Membangun Generasi Unggul</p>
                            </div>
                        </div>
                        <div class="footer-description">
                            <p>SMK Teknologi Pilar Bangsa adalah lembaga pendidikan menengah kejuruan yang berdedikasi untuk mengembangkan generasi muda dengan keahlian teknologi dan keterampilan yang relevan untuk masa depan.</p>
                        </div>
                        <div class="footer-contact-info">
                            <div class="contact-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <p>Jl. Raya Mauk No.KM.08, Karet, Sepatan Timur, Kabupaten Tangerang, Banten 15520</p>
                            </div>
                            <div class="contact-item">
                                <i class="fa fa-phone-alt"></i>
                                <p><a href="tel:+6282111103042">+62 821 1110 3042</a></p>
                            </div>
                            <div class="contact-item">
                                <i class="fa fa-envelope"></i>
                                <p><a href="mailto:teknologi.pilarbangsa@yahoo.com">teknologi.pilarbangsa@yahoo.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Tentang Kami</h4>
                        <div class="footer-widget-divider"></div>
                        <ul class="footer-links">
                            <li><a href="<?= base_url('welcome/tentang') ?>"><i class="fa fa-angle-right"></i> Tentang Sekolah</a></li>
                            <li><a href="<?= base_url('welcome/kontak') ?>"><i class="fa fa-angle-right"></i> Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Jurusan</h4>
                        <div class="footer-widget-divider"></div>
                        <ul class="footer-links">
                            <li><a href="<?= base_url('welcome/detail_jurusan/multimedia') ?>"><i class="fa fa-angle-right"></i> Multimedia / DKV</a></li>
                            <li><a href="<?= base_url('welcome/detail_jurusan/otkp') ?>"><i class="fa fa-angle-right"></i> OTKP / MP</a></li>
                            <li><a href="<?= base_url('welcome/detail_jurusan/tkro') ?>"><i class="fa fa-angle-right"></i> TKRO / TKR</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">E-Learning</h4>
                        <div class="footer-widget-divider"></div>
                        <ul class="footer-links">
                            <li><a href="<?= base_url('welcome/login_siswa') ?>"><i class="fa fa-angle-right"></i> Masuk Siswa</a></li>
                            <li><a href="<?= base_url('welcome/guru') ?>"><i class="fa fa-angle-right"></i> Masuk Guru</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Media Sosial</h4>
                        <div class="footer-widget-divider"></div>
                        <div class="footer-social-media">
                            <a href="https://www.facebook.com/pages/SMK-Teknologi-Pilar-Bangsa-KABTANGERANG/918213821587578" class="social-icon facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://www.tiktok.com/@teknologi.pilarbangsa" class="social-icon tiktok">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                            <a href="https://www.instagram.com/smk_tekpilarbangsa/" class="social-icon instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@pilarbangsatv2010" class="social-icon youtube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright">
                        <p>&copy; <?= date('Y') ?> SMK Teknologi Pilar Bangsa. All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="credits">
                        Developed with <i class="fa fa-heart"></i> by <a href="">The Debuggers</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================ End Footer Area Premium =================-->

<!-- Scroll Top Button -->
<div class="scroll-top-btn">
    <i class="fa fa-angle-up"></i>
</div>

<!-- Sweetaler Flashdata -->
<?php if ($this->session->flashdata('login-success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang kembali!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-login-user')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang kembali!',
            showConfirmButton: false,
            timer: 2500
        })
        <?php $this->session->unset_userdata('success-login-user'); ?>
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success-logout')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Kamu berhasil logout!',
            text: 'Selamat tinggal, Sampai jumpa lagi!',
            showConfirmButton: false,
            timer: 2500
        })
        <?php $this->session->unset_userdata('success-logout'); ?>
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('fail-login')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal login!',
            text: 'Silahkan Periksa Kembali Email dan Password Kamu!',
            showConfirmButton: false,
            timer: 2500
        });
        <?php $this->session->unset_userdata('fail-login'); ?>
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('fail-pass')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Password Salah!',
            text: 'Silahkan Periksa Kembali Password Kamu!',
            showConfirmButton: false,
            timer: 2500
        });
        <?php $this->session->unset_userdata('fail-pass'); ?>
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('not-login')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Harap Login Terlebih Dahulu !',
            text: 'Silahkan Login Dahulu !',
            showConfirmButton: false,
            timer: 2500
        });
        <?php $this->session->unset_userdata('not-login'); ?>
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('false-login')) : ?>
    <script>
        $("#exampleModalCenter").modal("show")
        <?php $this->session->unset_userdata('false-login'); ?>
    </script>
<?php endif; ?>

<script src="<?= base_url('assets/') ?>js/stellar.js"></script>
<script src="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/') ?>vendors/counter-up/jquery.counterup.js"></script>
<script src="<?= base_url('assets/') ?>js/mail-script.js"></script>
<script src="<?= base_url('assets/') ?>js/theme.js"></script>
<script>
    var animateButton = function(e) {
        e.preventDefault;
        e.target.classList.remove('animate');
        e.target.classList.add('animate');
        setTimeout(function() {
            e.target.classList.remove('animate');
        }, 700);
    };

    var bubblyButtons = document.getElementsByClassName("bubbly-button");

    for (var i = 0; i < bubblyButtons.length; i++) {
        bubblyButtons[i].addEventListener('click', animateButton, false);
    }
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- Script Scroll Top -->
<script>
    // Scroll to Top Button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.scroll-top-btn').addClass('show');
        } else {
            $('.scroll-top-btn').removeClass('show');
        }
    });

    $('.scroll-top-btn').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
</script>
</body>

</html>