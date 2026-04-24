<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo">
</p>

<h1 align="center">CV KABAYAN GROUP - MANAGEMENT SYSTEM</h1>

<p align="center">
    <strong>Internal Point of Sales (POS) & Inventory Management System</strong>
</p>

---

## 🏢 Tentang Proyek
Sistem ini dirancang khusus untuk operasional **CV KABAYAN GROUP** guna mengelola transaksi penjualan, inventaris barang, dan laporan keuangan secara *real-time*. Dibangun dengan framework Laravel untuk menjamin keamanan dan skalabilitas data perusahaan.

### Fitur Utama:
* **Point of Sales (POS):** Transaksi penjualan cepat dengan fitur pencarian produk.
* **Manajemen Inventaris:** Akumulasi stok otomatis dan peringatan stok kritis.
* **Laporan Penjualan:** Filter laporan berdasarkan tanggal/tahun dan ekspor ke PDF.
* **Cetak Struk:** Fitur cetak struk belanja otomatis untuk pelanggan.
* **Keamanan Akses:** Sistem autentikasi ketat untuk staf operasional.

---

## 🛠 Langkah Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Persyaratan Sistem
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL / MariaDB

### 2. Kloning Repositori
```bash
git clone [https://github.com/code-dias/cv-kabayan-test.git](https://github.com/code-dias/cv-kabayan-test.git)
cd cv-kabayan-test

# Instal library PHP
composer install

# Instal library JavaScript
npm install

cp .env.example .env

DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=

# Membuat key aplikasi
php artisan key:generate

# Menjalankan migrasi database
php artisan migrate

php artisan serve

npm run dev

Sistem ini bersifat internal untuk CV KABAYAN GROUP. Dasar framework menggunakan Laravel yang berlisensi MIT license.
Copyright to code-dias 
