
# Backend API Documentation Setup - Data Entry

## Deskripsi Proyek

Proyek API ini dibangun menggunakan **Laravel 11** untuk mendukung pengumpulan, pengelolaan, dan integrasi data profil pengguna. API ini dikembangkan sebagai bagian dari sistem berbasis web untuk memfasilitasi berbagai peran pengguna, seperti Entri Data, Manajer/Admin, dan Pengguna Kementerian, dalam mengelola data.

## Langkah-Langkah Instalasi dan Penggunaan

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan API di lingkungan lokal Anda.

### 1. Clone Repository atau Extract Source File

Clone repository proyek ini dengan perintah berikut:

```bash
git clone https://github.com/rahoelr/entry-data-api
```

### 2. Instalasi Dependensi dengan Composer

Setelah repository berhasil di-clone, masuk ke direktori proyek dan instal dependensi menggunakan Composer:

```bash
cd laravel-api
composer install
```

### 3. Konfigurasi File `.env` dan Pengaturan Database

- Salin file `.env.example` menjadi file `.env`:

  ```bash
  cp .env.example .env
  ```

- Buka file `.env` dan sesuaikan pengaturan database Anda. Berikut adalah contoh konfigurasi untuk MySQL:

  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nama_db
  DB_USERNAME=username_db
  DB_PASSWORD=pass_db
  ```
    - Pastikan Anda telah membuat database dengan nama yang disebutkan pada `DB_DATABASE`.
  

- Pengaturan Email SMTP untuk Konfirmasi Email
  API ini memerlukan pengaturan SMTP untuk mengirimkan email konfirmasi. Berikut adalah contoh pengaturan SMTP untuk Gmail:
  ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=aknatha02@gmail.com
    MAIL_PASSWORD="qyay atoe brez wuzx"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=aknatha02@gmail.com
    MAIL_FROM_NAME="Data Entry"
  ```
- Catatan Penting:
    - Aktifkan "Akses Aplikasi yang Kurang Aman" (untuk Gmail):
      - Gunakan App Passwords untuk keamanan tambahan. Langkah-langkah membuat App Password:
      - Masuk ke akun Google Anda.
      - Akses Google Account Settings.
      - Di bagian "Sign-in & Security", pilih App Passwords.
      - Ikuti petunjuk untuk menghasilkan kata sandi aplikasi khusus.
    - Gunakan Kata Sandi Aplikasi sebagai nilai untuk MAIL_PASSWORD.
    - Setelah konfigurasi selesai, lakukan pengujian untuk memastikan pengaturan SMTP sudah benar.

- Pastikan Anda telah melakukan setup `email smtp` yang akan digunakan sebagai pengirim mail.

### 4. Generate Key Aplikasi

Laravel memerlukan key untuk enkripsi dan penyimpanan sesi. Jalankan perintah berikut untuk menghasilkan key aplikasi:

```bash
php artisan key:generate
```


### 5. Migrasi Database

Setelah mengonfigurasi file `.env`, jalankan migrasi untuk membuat struktur tabel di database:

```bash
php artisan migrate
```

### 6. Jalankan Seeder untuk Membuat User Pertama

Proyek ini memerlukan beberapa data awal untuk tabel `users`. Sebelum menjalankan seeder, Anda dapat memodifikasi data akun admin di file `DatabaseSeeder` sesuai dengan kebutuhan Anda.

#### Langkah-langkah:

1. **Temukan file seeder**
   File seeder terletak di direktori `database/seeders/DatabaseSeeder.php`.

2. **Edit data akun admin (opsional)**
   Anda dapat mengubah data default berikut:

   ```php
   User::create([
       'name' => 'admin',
       'username' => 'admin',
       'email' => 'admin@email.com',
       'password' => Hash::make('admin2025'),
       'role' => 'manager',
       'status' => 'active',
   ]);
   ```

   Misalnya, untuk mengganti nama atau email admin:

   ```php
   User::create([
       'name' => 'superadmin',
       'username' => 'superadmin',
       'email' => 'superadmin@email.com',
       'password' => Hash::make('supersecure2025'),
       'role' => 'admin',
       'status' => 'active',
   ]);
   ```

3. **Jalankan Seeder**
   Setelah memastikan data sudah sesuai, jalankan perintah berikut untuk mengisi data awal ke database:

   ```bash
   php artisan db:seed
   ```

### 7. Jalankan Server Laravel

Untuk menjalankan server Laravel di lingkungan lokal, gunakan perintah:

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`. Anda juga bisa mengubah port dengan menambahkan opsi `--port`:

```bash
php artisan serve --port=8080
```

### 8. Dokumentasi API Postman

Dokumentasi API untuk proyek ini telah dibuat dan dipublikasikan di Postman. Pengguna dapat mengakses dokumentasi melalui tautan berikut:

```
https://documenter.getpostman.com/view/26411509/2sAYQfCU48
```

#### Cara Menggunakan Dokumentasi API:
1. **Akses Langsung:**
   Klik tautan di atas untuk membuka dokumentasi API yang telah dipublikasikan.

2. **Import Collection:**
   Selain mengakses langsung, Anda juga dapat mengimpor koleksi Postman yang telah diekspor. File koleksi dapat ditemukan di direktori proyek atau telah disediakan.

   **Langkah-langkah Import Collection:**
    - Buka aplikasi Postman.
    - Pilih opsi **Import**.
    - Unggah file koleksi `.json` yang telah diekspor.
    - Setelah diimpor, Anda dapat langsung mencoba endpoint API yang tersedia.

#### Catatan Penting
- Pastikan Anda telah mengonfigurasi environment Postman jika diperlukan, seperti URL dasar API atau token autentikasi.
- Gunakan dokumentasi ini untuk memahami setiap endpoint, termasuk parameter yang dibutuhkan, respons yang diharapkan, dan contoh penggunaan.


