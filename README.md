# Laravel 8 Project

Ini adalah aplikasi web berbasis Laravel 8. Di bawah ini adalah petunjuk untuk mengatur, menjalankan, dan mengembangkan proyek ini.

## Prerequisites

Sebelum mulai, pastikan Anda telah menginstal perangkat lunak berikut di sistem Anda:

- PHP 7.3 atau lebih baru
- Composer
- PostgreSQL
- Node.js dan NPM (untuk manajemen dependensi front-end)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini:

1. **Clone repository**

   ```bash
   git clone https://github.com/username/repository.git

2. **Masuk ke direktori proyek**
   ```bash
   cd repository
   
3. **Install dependensi PHP""
    ```bash
   composer install

4. ""Buat file '.env'**
    ```bash
   copy .env.example .env

5. ""Generate key aplikasi""
    ```bash
   php artisan key:generate

6. ""Set konfigurasi database""
    ```bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=nama_database
    DB_USERNAME=nama_pengguna
    DB_PASSWORD=kata_sandi

7. ""Jalankan migrasi database""
    ```bash
    php artisan migrate

8. ""Install dependensi front-end""
     ```bash
    npm install
          
9. ""Build aset front-end""
    ```bash
    npm run dev
    
10. ""Jalankan server pengembangan""
     ```bash
    php artisan serve
    
