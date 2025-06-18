# Learnix's - Sistem Pembelajaran Online

Sistem pembelajaran online berbasis CodeIgniter 3 untuk sekolah/madrasah dengan fitur diskusi, tugas, jadwal, dan manajemen kelas.

## 🚀 Fitur Utama

- **Dashboard Admin**: Manajemen guru, siswa, kelas, dan jadwal
- **Dashboard Guru**: Upload materi, buat tugas, dan kelola kelas
- **Dashboard Siswa**: Akses materi, submit tugas, dan lihat jadwal
- **Sistem Diskusi**: Forum diskusi antar siswa dan guru
- **Manajemen File**: Upload dan download materi pembelajaran
- **Sistem Notifikasi**: Pemberitahuan tugas dan pengumuman

## 📋 Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx web server
- CodeIgniter 3.x

## 🛠️ Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/BismillahSidang.git
   cd BismillahSidang
   ```

2. **Konfigurasi Database**
   - Buat database MySQL baru
   - Import file `database/teknologi-pilar-bangsa.sql`
   - Salin `application/config/database.php.example` ke `application/config/database.php`
   - Sesuaikan konfigurasi database di file tersebut

3. **Konfigurasi Aplikasi**
   - Salin `application/config/config.php.example` ke `application/config/config.php`
   - Sesuaikan base_url dan konfigurasi lainnya

4. **Set Permission**
   ```bash
   chmod 755 application/cache/
   chmod 755 application/logs/
   chmod 755 uploads/
   ```

5. **Akses Aplikasi**
   - Buka browser dan akses `http://localhost/BismillahSidang`

## 👥 Akun Default

### Admin
- Username: `admin`
- Password: `admin123`

### Guru
- Username: `guru`
- Password: `guru123`

### Siswa
- Username: `siswa`
- Password: `siswa123`

## 📁 Struktur Project

```
BismillahSidang/
├── application/
│   ├── controllers/     # Controller aplikasi
│   ├── models/         # Model database
│   ├── views/          # View/template
│   └── config/         # Konfigurasi
├── assets/             # Asset statis (CSS, JS, Images)
├── system/             # Core CodeIgniter
├── uploads/            # File upload
└── database/           # File database
```

## 🔧 Konfigurasi

### Database
Edit file `application/config/database.php`:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'your_database',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

## 🚀 Deployment

1. Upload semua file ke server web
2. Set permission folder yang diperlukan
3. Import database
4. Konfigurasi database dan aplikasi
5. Akses aplikasi melalui domain

## 📝 Changelog

### v1.0.0
- Fitur dasar sistem pembelajaran
- Dashboard admin, guru, dan siswa
- Sistem diskusi dan tugas
- Manajemen file upload

## 🤝 Kontribusi

1. Fork project
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Developer

Dikembangkan dengan ❤️ untuk kemajuan pendidikan Indonesia.

---

**BismillahSidang** - Sistem Pembelajaran Online yang Terpercaya 
