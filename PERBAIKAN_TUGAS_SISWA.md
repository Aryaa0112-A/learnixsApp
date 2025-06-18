# Perbaikan Sistem Pengerjaan Tugas Siswa

## Masalah yang Ditemukan

1. **Method `kerjakan_tugas` belum diimplementasi** - Siswa tidak bisa mengakses halaman untuk mengumpulkan tugas file
2. **Inkonsistensi penggunaan tabel** - Ada penggunaan tabel `pengumpulan_tugas` dan `submission_tugas` yang tidak konsisten
3. **Template yang tidak sesuai** - Beberapa view menggunakan template yang salah
4. **CSS styling yang kurang** - Beberapa komponen tidak memiliki styling yang memadai

## Perbaikan yang Dilakukan

### 1. Implementasi Method `kerjakan_tugas`

**File:** `application/controllers/User.php`

```php
public function kerjakan_tugas($id_tugas)
{
    $data['user'] = $this->db->get_where('siswa', ['email' =>
        $this->session->userdata('email')])->row_array();
    $id_siswa = $data['user']['id_siswa'];

    $this->load->model('M_tugas');

    $tugas = $this->M_tugas->get_tugas_by_id($id_tugas);

    if (!$tugas) {
        $this->session->set_flashdata('error', 'Tugas tidak ditemukan.');
        redirect('user/tugas');
    }

    // Check if deadline has passed
    if (strtotime($tugas->deadline) < time()) {
        $this->session->set_flashdata('error', 'Waktu pengerjaan tugas ini sudah berakhir.');
        redirect('user/tugas');
    }

    // Check if student has already submitted this task
    $submission_status = $this->M_tugas->get_status_tugas($id_tugas, $id_siswa);
    if ($submission_status && $submission_status->status == 'sudah') {
        $this->session->set_flashdata('info', 'Anda sudah mengumpulkan tugas ini.');
        redirect('user/tugas');
    }

    $data['tugas'] = $tugas;

    $this->load->view('user/submit_tugas', $data);
}
```

### 2. Perbaikan Konsistensi Tabel

**File:** `application/controllers/User.php`

- Mengubah semua referensi dari `pengumpulan_tugas` ke `submission_tugas`
- Memperbaiki method `tugas()` untuk menggunakan tabel yang benar
- Memperbaiki method `submit_quiz_answers()` untuk konsistensi

### 3. Perbaikan Template

**File:** `application/views/user/submit_tugas.php`
- Menambahkan title yang hilang
- Memperbaiki struktur template

**File:** `application/views/user/kerjakan_quiz.php`
- Menghapus baris yang salah ditambahkan
- Memperbaiki struktur template

### 4. Penambahan CSS Styling

**File:** `assets/css/user_style.css`

Menambahkan styling untuk:
- Statistics cards
- Task table
- Buttons
- Quiz form
- File upload
- Alert styling
- Card styling
- Form styling
- Responsive design
- Animations
- Custom scrollbar

## Fitur yang Sekarang Berfungsi

### 1. Pengerjaan Tugas File
- Siswa dapat mengakses halaman upload tugas
- Validasi deadline
- Validasi status pengumpulan
- Upload file dengan berbagai format (PDF, DOC, ZIP, RAR, JPG, PNG)
- Maksimal ukuran file 2MB

### 2. Pengerjaan Quiz
- Siswa dapat mengakses halaman quiz
- Validasi deadline
- Validasi status pengumpulan
- Soal pilihan ganda dengan 4 pilihan (A, B, C, D)
- Perhitungan nilai otomatis
- Validasi semua soal harus dijawab

### 3. Dashboard Tugas
- Statistik total tugas, sudah dikerjakan, dan belum dikerjakan
- Tabel daftar tugas dengan status dan nilai
- Tombol aksi sesuai status tugas
- Responsive design

## Cara Penggunaan

### Untuk Siswa:

1. **Melihat Daftar Tugas:**
   - Login sebagai siswa
   - Akses menu "Tugas"
   - Lihat statistik dan daftar tugas

2. **Mengerjakan Tugas File:**
   - Klik tombol "Kumpulkan Tugas" pada tugas yang belum dikerjakan
   - Upload file tugas
   - Klik "Submit"

3. **Mengerjakan Quiz:**
   - Klik tombol "Kerjakan Quiz" pada tugas quiz
   - Jawab semua pertanyaan
   - Klik "Kumpulkan Jawaban"

### Untuk Guru:

1. **Membuat Tugas:**
   - Login sebagai guru
   - Akses menu "Tugas"
   - Klik "Tambah Tugas"
   - Isi form dan upload file (opsional)

2. **Membuat Quiz:**
   - Setelah membuat tugas, klik "Tambah Soal Pilihan Ganda"
   - Isi soal dan pilihan jawaban
   - Set kunci jawaban

## Database yang Digunakan

### Tabel Utama:
- `tugas` - Data tugas
- `submission_tugas` - Data pengumpulan tugas
- `soal_pilihan_ganda` - Data soal quiz
- `pilihan_jawaban` - Data pilihan jawaban quiz

### Relasi:
- `tugas` ↔ `submission_tugas` (1:N)
- `tugas` ↔ `soal_pilihan_ganda` (1:N)
- `soal_pilihan_ganda` ↔ `pilihan_jawaban` (1:1)

## Testing

Untuk memastikan sistem berfungsi dengan baik, lakukan testing:

1. **Test Tugas File:**
   - Buat tugas baru tanpa soal quiz
   - Login sebagai siswa
   - Coba upload file tugas
   - Verifikasi file tersimpan

2. **Test Quiz:**
   - Buat tugas dengan soal quiz
   - Login sebagai siswa
   - Coba kerjakan quiz
   - Verifikasi nilai terhitung otomatis

3. **Test Validasi:**
   - Coba akses tugas yang sudah lewat deadline
   - Coba akses tugas yang sudah dikumpulkan
   - Verifikasi pesan error yang muncul

## Catatan Penting

1. Pastikan folder `uploads/tugas/` memiliki permission write
2. Pastikan database menggunakan tabel `submission_tugas` bukan `pengumpulan_tugas`
3. Pastikan semua model dan controller sudah di-load dengan benar
4. Pastikan session siswa sudah aktif sebelum mengakses fitur tugas

## Troubleshooting

Jika masih ada masalah:

1. **Error 404 saat akses tugas:**
   - Periksa routing di `application/config/routes.php`
   - Pastikan method di controller ada dan benar

2. **File tidak terupload:**
   - Periksa permission folder upload
   - Periksa konfigurasi upload di controller

3. **Quiz tidak muncul:**
   - Periksa apakah soal sudah dibuat
   - Periksa relasi antara tugas dan soal

4. **Nilai tidak terhitung:**
   - Periksa kunci jawaban di database
   - Periksa logika perhitungan di controller 