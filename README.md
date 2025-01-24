
# Backend API Documentation Setup - Data Entry

## Deskripsi Proyek

Proyek API ini dibangun menggunakan **Laravel 11** untuk mengelola data persetujuan dan pengeluaran dalam sistem. API ini menyediakan endpoint untuk membuat dan memperbarui tahap persetujuan (`approval stages`), membuat pengeluaran (`expenses`), serta melakukan persetujuan pengeluaran oleh `approvers`. Semua endpoint API didokumentasikan menggunakan Swagger.

## Langkah-Langkah Instalasi dan Penggunaan

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan API di lingkungan lokal Anda.

### 1. Clone Repository

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

- Setting EMAIL SMTP :
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

- Pastikan Anda telah membuat database dengan nama yang disebutkan pada `DB_DATABASE`.
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

### 6. Jalankan Seeder untuk Status

Proyek ini memerlukan beberapa data awal untuk tabel `users`. Jalankan perintah berikut untuk mengisinya:

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

### 8. Generasi Dokumentasi Swagger

Setelah server berjalan, jalankan perintah berikut untuk menghasilkan dokumentasi Swagger:

```bash
php artisan l5-swagger:generate
```

Perintah ini akan memindai rute API Anda dan menghasilkan dokumentasi berdasarkan anotasi yang ada di dalam controller dan model.

### 9. Akses Dokumentasi Swagger

Setelah berhasil menggenerate dokumentasi, Anda dapat mengakses Swagger UI di browser menggunakan URL berikut:

```plaintext
http://127.0.0.1:8000/api/documentation
```

Swagger UI akan menampilkan daftar endpoint API yang tersedia dan memungkinkan Anda untuk menguji endpoint tersebut langsung dari antarmuka.

### 10. Urutan Menjalankan Endpoint API

Ikuti urutan berikut untuk menjalankan endpoint API secara berurutan:

1. **Buat Approvers**
    - Pertama, buatlah `approvers` (misalnya 4 approvers). Anda dapat menggunakan endpoint `POST /api/approvers` untuk menambah approvers baru.
    - Endpoint yang digunakan: `POST api/approvers`
    - Response:
      ```json
      {
        "success": true,
        "data": {
          "id": 4,
          "name": "RARA"
        },
        "message": "Approver created successfully."
      }
      ```

2. **Buat Approval Stage Berdasarkan Approvers**
    - Setelah approvers dibuat, buatlah `approval stage` yang mencakup approvers yang sudah Anda buat. Gunakan endpoint `POST /api/approval-stages` untuk membuat approval stage baru.
    - Endpoint yang digunakan: `POST api/approval-stages`
    - Response:
      ```json
      {
        "success": true,
        "data": {
          "id": 3,
          "approver": {
            "id": 5,
            "name": "bagus"
          }
        },
        "message": "Approval stage created successfully."
      }
      ```

3. **Update Approval Stage**
    - Setelah approval stage dibuat, Anda dapat mengupdate `approval stage` menggunakan endpoint `PUT /api/approval-stages/{id}`.
    - Endpoint yang digunakan: `PUT api/approval-stages/{id}`
    - Response:
      ```json
      {
        "success": true,
        "data": {
          "id": 3,
          "approver": {
            "id": 5,
            "name": "bagus"
          }
        },
        "message": "Approval stage updated successfully."
      }
      ```

4. **Buat Expense Baru**
    - Setelah membuat approval stage, Anda dapat membuat pengeluaran baru yang akan terkait dengan approval stage yang sudah dibuat sebelumnya. Gunakan endpoint `POST /api/expenses` untuk membuat pengeluaran baru.
    - Endpoint yang digunakan: `POST api/expenses`
    - Response:
      ```json
        
      ```

5. **Approve Expense**
    - Setelah membuat pengeluaran, approvers yang terkait dapat melakukan persetujuan pada pengeluaran berdasarkan approval stage yang telah dibuat. Gunakan endpoint `PATCH /api/expenses/{id}/approve` untuk melakukan persetujuan pada pengeluaran.
    - Endpoint yang digunakan: `PATCH api/expenses/{id}/approve`
    - Response:
      ```json
      {
        "success": true,
        "data": {
          "id": 4,
          "amount": 121212,
          "status_id": 2,
          "created_at": "2024-11-29T08:01:30.000000Z",
          "updated_at": "2024-11-29T08:02:08.000000Z"
        },
        "message": "Expense approved successfully."
      }
      ```

### Troubleshooting

Jika Anda menemui masalah, berikut beberapa solusi yang bisa dicoba:

- **Masalah dengan Composer Install**: Pastikan PHP dan Composer telah terinstal dengan benar. Jika ada masalah terkait dependensi, coba jalankan `composer update`.
- **Masalah Koneksi Database**: Pastikan database Anda berjalan dengan baik dan kredensial di `.env` sudah benar.
- **Dokumentasi Swagger Tidak Terupdate**: Jika ada perubahan pada controller atau rute yang tidak terupdate di Swagger, jalankan perintah berikut untuk menghapus cache dan regenerate dokumentasi:

  ```bash
  php artisan cache:clear
  php artisan l5-swagger:generate
  ```
