# BOA Futsal Arena ⚽

BOA Futsal adalah aplikasi web modern dan responsif yang dirancang untuk mengelola pemesanan (booking) lapangan futsal. Dibangun menggunakan **Laravel 12** dan **Tailwind CSS**, aplikasi ini menghadirkan antarmuka (UI) bernuansa *dark mode* bergaya *glassmorphism* yang elegan, efek *smooth scrolling*, serta Panel Admin yang intuitif untuk mengelola pengguna, pesanan lapangan, dan pesan masuk.

## ✨ Fitur Utama

- **UI/UX Modern**: Tema *dark mode* elegan dengan efek *glassmorphism* yang menggunakan Tailwind CSS.
- **Animasi Super Mulus**: Menggunakan Animate On Scroll (AOS) sehingga setiap elemen akan muncul perlahan secara interaktif dan elegan saat di-*scroll*.
- **Desain Responsif**: Tampilan sangat dioptimalkan dan tetap rapi ketika dibuka melalui desktop, tablet, maupun ponsel.
- **Landing Page Interaktif**: Menampilkan informasi seputar fasilitas, daftar lapangan, lokasi aktual (terintegrasi dengan Google Maps), dan kontak kami.
- **Admin Dashboard**: Panel khusus administrator untuk mengatur pengguna, melihat daftar pemesanan, dan memantau pesan/penawaran kerja sama yang masuk.
- **Data Dinamis**: Menggunakan database MySQL dengan Laravel Eloquent ORM untuk pengolahan data yang tangguh dan aman.

## 🚀 Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templating, Tailwind CSS, Vanilla JS
- **Animasi**: AOS (Animate On Scroll)
- **Database**: MySQL / SQLite
- **Environment**: Laragon (Sangat direkomendasikan untuk pengembangan lokal)

## 🛠️ Panduan Instalasi & Persiapan

1. **Clone repositori ini**
   ```bash
   git clone https://github.com/Jonnint/Boa-Futsal.git
   cd Boa-Futsal/boafutsalv1
   ```

2. **Install dependensi PHP (Composer)**
   ```bash
   composer install
   ```

3. **Install dependensi NPM**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Gandakan file `.env.example` menjadi `.env` lalu hasilkan *app key*:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Jangan lupa sesuaikan pengaturan database (DB_DATABASE, DB_USERNAME, dll.) di dalam file `.env`.*

5. **Jalankan Migrasi & Seeder Database**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan Server Lokal**
   Gunakan perintah berikut di dua terminal (*command prompt*) yang berbeda:
   ```bash
   php artisan serve
   npm run dev
   ```
   Aplikasi BOA Futsal siap diakses melalui `http://localhost:8000`.

## 📱 Pembagian Hak Akses (Role)

- **Guest (Pengunjung Biasa)**: Bisa melihat *landing page*, menjelajahi fasilitas, informasi lapangan, lokasi, serta mengirim pesan saran atau tawaran kerja sama.
- **Pengguna Terdaftar**: Memiliki akses untuk memesan (*booking*) jadwal lapangan futsal.
- **Admin**: Memiliki akses ke halaman `/admin/dashboard` untuk mengelola seluruh data platform.

## 🎨 Highlight UI/UX

- **Footer Premium**: Didesain khusus menggunakan elemen memukau dan navigasi ringkas serta *Call to Action* (CTA).
- **Tombol WhatsApp Melayang**: Diletakkan secara proporsional dan otomatis menyesuaikan (*responsive resize*) di perangkat ponsel (*mobile*) agar pengunjung bisa langsung mengirim pesan tanpa halangan.
- **Smooth Scrolling (AOS)**: Transisi elemen-elemen dan navigasi tautan yang berjalan dengan mulus bagai mentega.

## 📜 Lisensi

Proyek ini adalah sistem *proprietary* yang dibuat khusus untuk BOA Futsal Arena.
