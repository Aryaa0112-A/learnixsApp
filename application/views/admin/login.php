<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>E-Learning - SMK Teknologi Pilar Bangsa</title>
    
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/') ?>img/favicon.png" type="image/png">
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="login-page">
        <div class="login-wrapper">
            <div class="login-brand">
                <div class="login-brand-header">
                    <div class="login-brand-logo">
                        <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo SMK Teknologi Pilar Bangsa">
                        <div class="brand-text">
                            <h4>E-Learnix's</h4>
                            <span class="brand-tagline" style="color: #fff;">Platform Pembelajaran Digital</span>
                        </div>
                    </div>
                </div>
                
                <div class="login-brand-content">
                    <h2>Selamat datang, Admin!</h2>
                    <p>Silahkan login untuk masuk ke panel administrator dan mengelola sistem pembelajaran digital.</p>
                </div>
                
                <div class="login-brand-footer">
                    <div class="illustration">
                        <img src="https://cdn-icons-png.flaticon.com/512/2999/2999635.png" alt="admin illustration">
                    </div>
                    <p>Made with <span style="color: #ff5e5e;">❤</span> by <a href="<?= base_url('welcome') ?>">SMK Teknologi Pilar Bangsa</a></p>
                </div>
            </div>
            
            <div class="login-form">
                <div class="login-form-header">
                    <h4>Login Admin</h4>
                    <p>Silahkan masukkan email dan password untuk mengakses panel admin.</p>
                </div>
                
                <?php if ($this->session->flashdata('fail-login')) : ?>
                    <div class="alert-login">
                        <i class="fas fa-exclamation-circle"></i>
                        Email atau password salah!
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('fail-email')) : ?>
                    <div class="alert-login">
                        <i class="fas fa-exclamation-circle"></i>
                        Email tidak aktif!
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('fail-pass')) : ?>
                    <div class="alert-login">
                        <i class="fas fa-exclamation-circle"></i>
                        Password salah!
                    </div>
                <?php endif; ?>
                
                <form method="post" action="<?= base_url('welcome/admin') ?>">
                    <div class="login-form-group">
                        <label for="email">Email</label>
                        <div class="input-icon-wrap">
                            <span class="input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="login-form-control" name="email" tabindex="1" required autofocus value="<?= $this->session->flashdata('email'); ?>">
                        </div>
                    </div>
                    
                    <div class="login-form-group">
                        <label for="password">Password</label>
                        <div class="input-icon-wrap">
                            <span class="input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password" type="password" class="login-form-control" name="password" tabindex="2" required value="<?= $this->session->flashdata('password'); ?>">
                            <span class="input-icon-right toggle-password">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="login-form-check">
                        <input type="checkbox" class="login-checkbox" id="remember" name="remember">
                        <label class="login-checkbox-label" for="remember">Ingat saya</label>
                    </div>
                    
                    <div class="login-terms">
                        Dengan login anda menyetujui <a href="#">privasi dan persyaratan ketentuan hukum kami</a>. 
                    </div>
                    
                    <button type="submit" class="login-button">
                        Login Sekarang
                    </button>
                    
                    <div class="login-back">
                        <a href="<?= base_url('welcome') ?>">
                            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start Sweetalert Flashdata -->
    <?php if ($this->session->flashdata('success-reg')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Kamu berhasil daftar!',
                text: 'Silahkan Cek Email Kamu, Buat Verifikasi!',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login-success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Kamu berhasil daftar!',
                text: 'Sekarang login yuk!',
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
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success-verify')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Email Telah Diverifikasi!',
                text: 'Sekarang login yuk!',
                showConfirmButton: false,
                timer: 2500
            })
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
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('fail-email')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email Belum Diverifikasi!',
                text: 'Silahkan Cek Email Kamu Dahulu!',
                showConfirmButton: false,
                timer: 2500
            })
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
        </script>
    <?php endif; ?>
    <!-- End Sweetalert -->

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>