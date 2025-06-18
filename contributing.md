# Panduan Kontribusi

Terima kasih telah tertarik untuk berkontribusi pada project **BismillahSidang**! 

## 🚀 Cara Berkontribusi

### 1. Fork Repository
- Klik tombol "Fork" di halaman repository GitHub
- Clone repository yang sudah di-fork ke komputer Anda

### 2. Setup Development Environment
```bash
# Clone repository
git clone https://github.com/YOUR_USERNAME/BismillahSidang.git
cd BismillahSidang

# Install dependencies (jika menggunakan Composer)
composer install

# Setup database
# - Buat database baru
# - Import file database/teknologi-pilar-bangsa.sql
# - Copy application/config/database.php.example ke application/config/database.php
# - Sesuaikan konfigurasi database

# Setup aplikasi
# - Copy application/config/config.php.example ke application/config/config.php
# - Sesuaikan base_url dan konfigurasi lainnya
```

### 3. Buat Branch untuk Fitur Baru
```bash
git checkout -b feature/nama-fitur-anda
```

### 4. Lakukan Perubahan
- Buat perubahan sesuai dengan fitur yang ingin ditambahkan
- Pastikan kode mengikuti standar coding yang ada
- Tambahkan komentar jika diperlukan
- Test fitur yang dibuat

### 5. Commit Perubahan
```bash
git add .
git commit -m "feat: tambahkan fitur [nama fitur]"
```

### 6. Push ke Repository
```bash
git push origin feature/nama-fitur-anda
```

### 7. Buat Pull Request
- Buka repository yang sudah di-fork di GitHub
- Klik "Compare & pull request"
- Isi deskripsi perubahan
- Submit pull request

## 📋 Standar Coding

### PHP (CodeIgniter)
- Gunakan PSR-4 autoloading
- Ikuti standar penamaan CodeIgniter
- Gunakan camelCase untuk method dan variable
- Gunakan PascalCase untuk class
- Tambahkan komentar untuk method yang kompleks

### JavaScript
- Gunakan ES6+ syntax
- Gunakan camelCase untuk variable dan function
- Gunakan PascalCase untuk class
- Tambahkan semicolon di akhir statement

### CSS
- Gunakan BEM methodology
- Gunakan kebab-case untuk class name
- Organisir CSS dengan baik (layout, component, utility)

## 🐛 Melaporkan Bug

Jika Anda menemukan bug, silakan:

1. Cek apakah bug sudah dilaporkan di [Issues](https://github.com/username/BismillahSidang/issues)
2. Buat issue baru dengan template yang disediakan
3. Jelaskan langkah-langkah untuk reproduce bug
4. Sertakan screenshot jika diperlukan
5. Jelaskan environment yang digunakan (OS, browser, dll)

## 💡 Mengusulkan Fitur

Untuk mengusulkan fitur baru:

1. Buat issue dengan label "enhancement"
2. Jelaskan fitur yang diusulkan secara detail
3. Jelaskan manfaat dari fitur tersebut
4. Sertakan mockup/wireframe jika ada

## 📝 Commit Message Convention

Gunakan format berikut untuk commit message:

```
type(scope): description

[optional body]

[optional footer]
```

### Types:
- `feat`: Fitur baru
- `fix`: Perbaikan bug
- `docs`: Perubahan dokumentasi
- `style`: Perubahan format (spacing, semicolon, dll)
- `refactor`: Refactoring kode
- `test`: Menambah atau memperbaiki test
- `chore`: Perubahan build process, tools, dll

### Contoh:
```
feat(auth): tambahkan sistem login dengan OAuth
fix(database): perbaiki query yang menyebabkan memory leak
docs(readme): update panduan instalasi
```

## 🔍 Review Process

1. Setiap pull request akan direview oleh maintainer
2. Pastikan semua test berjalan dengan baik
3. Pastikan tidak ada conflict dengan branch utama
4. Maintainer akan memberikan feedback jika ada yang perlu diperbaiki
5. Setelah disetujui, pull request akan di-merge

## 📞 Kontak

Jika ada pertanyaan atau butuh bantuan, silakan:

- Buat issue di GitHub
- Hubungi maintainer melalui email
- Diskusikan di forum komunitas

---

**Terima kasih atas kontribusi Anda untuk kemajuan pendidikan Indonesia!** 🇮🇩
