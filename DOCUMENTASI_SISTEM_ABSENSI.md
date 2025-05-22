# Dokumentasi Sistem Absensi Karyawan

## Daftar Isi
1. [Pendahuluan](#pendahuluan)
2. [Fitur](#fitur)
3. [Persyaratan Sistem](#persyaratan-sistem)
4. [Instalasi](#instalasi)
5. [Struktur Proyek](#struktur-proyek)
6. [Cara Penggunaan](#cara-penggunaan)
7. [Role dan Hak Akses](#role-dan-hak-akses)
8. [Endpoint API](#endpoint-api)
9. [Troubleshooting](#troubleshooting)
10. [Kontribusi](#kontribusi)

## Pendahuluan
Sistem Absensi Karyawan adalah aplikasi web yang dibangun menggunakan framework Laravel untuk memudahkan manajemen kehadiran karyawan. Aplikasi ini memungkinkan karyawan untuk melakukan check-in dan memantau riwayat kehadiran mereka, sementara admin dapat mengelola data pengguna dan melihat laporan kehadiran.

## Fitur
- **Autentikasi Pengguna**
  - Login/Logout
  - Multi-role (Super Admin dan Karyawan)
  
- **Manajemen Karyawan**
  - Tambah karyawan baru
  - Lihat daftar karyawan
  - Hapus akun karyawan
  
- **Absensi**
  - Check-in dengan catatan
  - Riwayat absensi
  - Filter berdasarkan pengguna (untuk admin)

## Persyaratan Sistem
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM
- Web Server (Apache/Nginx)
- Git

## Instalasi

### 1. Clone Repository
```bash
git clone [URL_REPOSITORY]
cd attendance-system
```

### 2. Install Dependensi
```bash
composer install
npm install
npm run dev
```

### 3. Konfigurasi
1. Salin file `.env.example` menjadi `.env`
2. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
3. Konfigurasi koneksi database di file `.env`

### 4. Migrasi Database
```bash
php artisan migrate --seed
```

### 5. Jalankan Aplikasi
```bash
php artisan serve
```

## Struktur Proyek
```
attendance-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── AttendanceController.php
│   │   └── UserController.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Attendance.php
│   └── Http/Middleware/
│       └── CheckRole.php
├── database/migrations/
├── resources/views/
│   ├── attendances/
│   │   └── index.blade.php
│   ├── users/
│   │   ├── index.blade.php
│   │   └── create.blade.php
│   └── layouts/
│       └── app.blade.php
├── routes/
│   └── web.php
└── public/
```

## Cara Penggunaan

### 1. Login
1. Buka halaman login
2. Masukkan email dan password
3. Klik tombol "Login"

### 2. Sebagai Karyawan
- **Check-in**
  1. Klik tombol "Check In"
  2. Isi catatan (opsional)
  3. Klik "Submit"

- **Lihat Riwayat**
  - Riwayat absensi akan ditampilkan di halaman dashboard

### 3. Sebagai Super Admin
- **Kelola Karyawan**
  1. Navigasi ke "Kelola Pengguna"
  2. Klik "Tambah Karyawan" untuk menambah pengguna baru
  3. Isi formulir pendaftaran
  4. Klik "Simpan"

- **Lihat Semua Absensi**
  - Semua riwayat absensi akan ditampilkan di dashboard admin

## Role dan Hak Akses

### 1. Super Admin
- Mengelola data karyawan
- Melihat semua riwayat absensi
- Menghapus akun karyawan

### 2. Karyawan
- Melakukan check-in
- Melihat riwayat absensi pribadi
- Menambahkan catatan saat check-in

## Endpoint API

### Autentikasi
- `POST /login` - Login pengguna
- `POST /logout` - Logout pengguna

### Absensi
- `GET /` - Tampilkan daftar absensi
- `POST /attendances` - Tambah absensi baru (check-in)

### Manajemen Pengguna (Hanya Super Admin)
- `GET /users` - Tampilkan daftar pengguna
- `GET /users/create` - Tampilkan form tambah pengguna
- `POST /users` - Simpan data pengguna baru
- `DELETE /users/{user}` - Hapus pengguna

## Troubleshooting

### 1. Error "Target class [role] does not exist"
Pastikan:
- Middleware sudah terdaftar di `app/Http/Kernel.php`
- Sudah menjalankan `composer dump-autoload`
- Nama file dan class middleware sudah sesuai

### 2. Error "Call to a member function format() on string"
Pastikan:
- Field tanggal di model sudah di-cast sebagai `datetime`
- Tidak ada konflik middleware antara controller dan route

### 3. Halaman tidak ditemukan (404)
- Pastikan route sudah didefinisikan di `routes/web.php`
- Jalankan `php artisan route:clear`
- Pastikan file view ada di direktori yang benar

## Kontribusi
1. Fork repository
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi
[MIT License](LICENSE)
