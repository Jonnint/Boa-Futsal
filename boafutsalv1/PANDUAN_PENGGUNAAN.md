# Panduan Penggunaan — BOA Futsal Website

Dokumen ini menjelaskan cara menggunakan sistem website BOA Futsal, baik untuk pengunjung, pengguna terdaftar, maupun admin.

---

## Daftar Isi

1. [Halaman Utama](#1-halaman-utama)
2. [Registrasi & Login](#2-registrasi--login)
3. [Booking Lapangan](#3-booking-lapangan)
4. [Dashboard Pengguna](#4-dashboard-pengguna)
5. [Komentar & Collab](#5-komentar--collab)
6. [Dashboard Admin](#6-dashboard-admin)
7. [Kelola Booking (Admin)](#7-kelola-booking-admin)
8. [Kelola User (Admin)](#8-kelola-user-admin)
9. [Pesan Masuk (Admin)](#9-pesan-masuk-admin)
10. [Alur Status Booking](#10-alur-status-booking)

---

## 1. Halaman Utama

Halaman utama dapat diakses tanpa login di `http://localhost:8000`.

**Bagian-bagian halaman:**

- **Hero Section** — tombol "Jelajahi Lapangan" dan "Booking" mengarah ke section lapangan
- **Fasilitas** — informasi toilet, kasir & parkir, mushola
- **Pilih Arena** — daftar lapangan aktif beserta status real-time (tersedia / sedang dipakai)
- **Contact Us** — dua tab: Komentar Umum dan Collab & Sponsorship

**Status lapangan real-time** diperbarui otomatis setiap 30 detik. Lapangan yang sedang dipakai akan menampilkan badge merah beserta sisa waktu.

---

## 2. Registrasi & Login

### Registrasi

1. Klik tombol **Login** di navbar
2. Klik link **Register** di halaman login
3. Isi nama, email, dan password
4. Klik **Register**
5. Verifikasi email jika diminta

### Login

1. Klik tombol **Login** di navbar
2. Masukkan email dan password
3. Klik **Log in**

> Admin akan otomatis diarahkan ke `/admin/dashboard` setelah login.

---

## 3. Booking Lapangan

> Membutuhkan login.

### Langkah booking:

1. Scroll ke section **Pilih Arena** di halaman utama
2. Klik tombol **Detail Harga** pada lapangan yang diinginkan
3. Modal harga akan muncul — cek tarif weekday/weekend
4. Klik **BOOKING SEKARANG**
5. Isi form booking:
   - **Tanggal** — pilih tanggal (minimal hari ini)
   - **Jam Mulai** — pilih jam tersedia
   - **Durasi** — 1–8 jam
   - **Catatan** — opsional
6. Sistem otomatis menghitung total harga berdasarkan:
   - Hari (weekday/weekend)
   - Jam (pagi/siang/malam)
   - Status member/non-member
7. Klik **Buat Booking**

### Setelah booking:

- Status awal: **Pending**
- Halaman detail booking akan tampil dengan instruksi pembayaran
- Tunggu konfirmasi dari admin

### Cek jadwal lapangan:

Di halaman booking, tersedia kalender jadwal yang menampilkan slot yang sudah terisi agar tidak bentrok.

---

## 4. Dashboard Pengguna

Akses di `/dashboard` setelah login.

Menampilkan:
- **Total Booking** — jumlah semua booking yang pernah dibuat
- **Booking Aktif** — booking dengan status pending atau confirmed
- **Total Pengeluaran** — akumulasi dari booking confirmed dan completed

---

## 5. Komentar & Collab

### Komentar Umum

1. Scroll ke section **Contact Us**
2. Pastikan tab **Komentar Umum** aktif
3. Login terlebih dahulu (nama dan email otomatis terisi)
4. Isi subjek dan komentar
5. Klik **Kirim Komentar**
6. Notifikasi toast akan muncul di pojok kanan atas
7. Komentar langsung tampil di bagian **Komentar Pengunjung** (maks. 5 terlihat, sisanya bisa di-scroll)

### Collab & Sponsorship

1. Klik tab **Collab & Sponsorship**
2. Isi nama/perusahaan, email, jenis kerjasama, dan detail proposal
3. Klik **Kirim Proposal**
4. Pesan akan masuk ke inbox admin (tidak tampil publik)

---

## 6. Dashboard Admin

Akses di `/admin/dashboard` — hanya untuk akun dengan role `admin`.

**Statistik yang ditampilkan:**
- Total booking, booking pending, booking confirmed
- Total user terdaftar
- Total revenue dan pending revenue
- Jumlah pesan collab belum dibaca

**Recent Bookings** — 10 booking terbaru dengan status dan aksi cepat.

**Recent Messages** — 5 pesan collab/sponsorship terbaru.

---

## 7. Kelola Booking (Admin)

Akses di `/admin/bookings`.

### Aksi yang tersedia per booking:

| Aksi | Keterangan |
|---|---|
| **Konfirmasi** | Ubah status dari `pending` → `confirmed` |
| **Selesai** | Ubah status dari `confirmed` → `completed` |
| **Batalkan** | Ubah status ke `cancelled` |
| **Hapus** | Hapus booking beserta data payment terkait |

### Filter status:

Booking ditampilkan urut berdasarkan tanggal terbaru, 20 per halaman dengan pagination.

---

## 8. Kelola User (Admin)

Akses di `/admin/users`.

- **Lihat daftar** semua user terdaftar
- **Tambah user** baru langsung dari admin
- **Edit** data user — nama, email, role, status member
- **Hapus** user (beserta semua booking terkait)

**Role yang tersedia:**
- `user` — pengguna biasa
- `admin` — akses penuh ke dashboard admin

**Status Member:**
- Member mendapatkan harga khusus (`price_member`) saat booking

---

## 9. Pesan Masuk (Admin)

Akses di `/admin/messages`.

Hanya menampilkan pesan bertipe **Collab & Sponsorship** (bukan komentar umum).

### Aksi per pesan:

| Ikon | Fungsi |
|---|---|
| ✓ (hijau) | Tandai sebagai sudah dibaca |
| ✉ (abu) | Balas via email langsung |
| 🗑 (merah) | Hapus pesan |

Pesan yang belum dibaca ditandai dengan badge **Baru** berwarna hijau dan border yang lebih terang.

---

## 10. Alur Status Booking

```
[Dibuat] → pending
              ↓
         [Admin Konfirmasi]
              ↓
          confirmed
              ↓
         [Admin Selesaikan]
              ↓
          completed

   (kapan saja) → cancelled
```

**Penjelasan status:**

| Status | Keterangan |
|---|---|
| `pending` | Booking baru dibuat, menunggu konfirmasi admin |
| `confirmed` | Admin sudah mengkonfirmasi, lapangan terjadwal |
| `completed` | Sesi selesai |
| `cancelled` | Booking dibatalkan oleh admin |

---

## Harga Lapangan

Harga dibagi berdasarkan:

- **Hari** — Weekday (Senin–Jumat) dan Weekend (Sabtu–Minggu)
- **Sesi waktu** — Pagi, Siang, Malam (sesuai konfigurasi di database)
- **Tipe pengguna** — Regular dan Member

Cek harga terkini dengan klik tombol **Detail Harga** di masing-masing lapangan.

---

## Kontak & Bantuan

- **Email:** admin@boafutsal.com
- **WhatsApp:** +62 812-3456-7890
- **Lokasi:** Jl. Cilangkap Raya, Jakarta Timur
