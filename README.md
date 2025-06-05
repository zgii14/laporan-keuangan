# Website Laporan Keuangan Sederhana

![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg?style=for-the-badge&logo=php)
![Laravel Version](https://img.shields.io/badge/Laravel-10.x-orange.svg?style=for-the-badge&logo=laravel)
![Lisensi](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

Aplikasi berbasis web yang dibangun dengan Laravel untuk melakukan pencatatan transaksi keuangan sederhana dan menghasilkan laporan keuangan standar secara otomatis. Proyek ini mengadopsi arsitektur Clean Code dengan Service Layer dan antarmuka profesional menggunakan template SB Admin 2.

![Screenshot Aplikasi](https://i.imgur.com/gSjGZ8a.png)

---

## 🚀 Fitur Utama

-   **Pencatatan Transaksi**: Input data pemasukan dan pengeluaran dengan kategori yang jelas.
-   **Tampilan Debit & Kredit**: Daftar transaksi disajikan dalam format debit dan kredit yang mudah dipahami.
-   **Filter Data**: Lakukan penyaringan data transaksi berdasarkan rentang tanggal dan kategori.
-   **Export ke Excel**: Ekspor data yang sudah difilter ke dalam format `.xlsx` menggunakan Maatwebsite/Excel.
-   **Laporan Keuangan Otomatis**:
    -   Laporan Arus Kas
    -   Laporan Laba Rugi
    -   Laporan Perubahan Modal
    -   Laporan Neraca
-   **UI Profesional**: Menggunakan template SB Admin 2 yang responsif dan modern.
-   **Notifikasi Interaktif**: Konfirmasi hapus dan notifikasi sukses menggunakan SweetAlert2.
-   **Arsitektur Clean Code**: Logika bisnis dipisahkan ke dalam *Service Layer* dan validasi form menggunakan *Form Requests*.

---

## 🛠️ Teknologi yang Digunakan

-   **Backend**: PHP 8.1+, Laravel 10.x
-   **Frontend**: Bootstrap 5, SB Admin 2, SweetAlert2, SASS
-   **Database**: MySQL / MariaDB
-   **Development**: Composer, NPM / Vite

---
