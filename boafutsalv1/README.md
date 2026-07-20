# BOA Futsal — Futsal Arena Booking System

> Sistem reservasi lapangan futsal berbasis web untuk BOA Futsal Arena, Cilangkap, Jakarta Timur.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=flat&logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?style=flat&logo=vite&logoColor=white)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Blade, Tailwind CSS, Alpine.js |
| Build Tool | Vite |
| Database | SQLite (dev) / MySQL (prod) |
| Auth | Laravel Breeze |

---

## Features

- **Booking Lapangan** — reservasi real-time dengan deteksi konflik jadwal
- **Harga Dinamis** — tarif berbeda untuk weekday/weekend dan member/non-member
- **Status Lapangan Real-time** — polling setiap 30 detik untuk status occupied/available
- **Role-based Access** — user biasa dan admin dengan dashboard terpisah
- **Membership System** — tiga tier member (Regular/VIP/VVIP) dengan upload bukti pembayaran
- **Voucher & Diskon** — kelola kode promo dari dashboard admin
- **Notifikasi Member** — notifikasi in-app untuk approval/reject pembayaran
- **WhatsApp Chatbot** — auto-reply via Fonnte API saat user upload bukti pembayaran member
- **Komentar Publik** — pengunjung bisa meninggalkan komentar di halaman utama
- **Admin Dashboard** — kelola booking, user, voucher, member, dan pesan masuk

---

## Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL (XAMPP atau sejenisnya)

---

## Installation

```bash
# 1. Clone repo
git clone https://github.com/username/boafutsalv1.git
cd boafutsalv1

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Setup database (pastikan MySQL sudah aktif)
php artisan migrate
php artisan db:seed

# 5. Build assets
npm run dev

# 6. Jalankan server
php artisan serve
```

---

## Seeding

Seeder akan membuat:
- **Admin** — `admin@boafutsal.com` / `password`
- **3 Lapangan** — BF 01, BF 02, BF 03 dengan harga weekday/weekend
- **Default Chatbot Setting** — konfigurasi default chatbot Fonnte

```bash
php artisan db:seed
```

---

## WhatsApp Chatbot Setup (Fonnte)

Fitur chatbot menggunakan [Fonnte API](https://fonnte.com) untuk auto-reply WhatsApp.

### Langkah Setup:

1. Daftar dan login ke [https://fonnte.com](https://fonnte.com)
2. Tambahkan device (nomor WA bot Anda) di dashboard Fonnte
3. Salin **API Token** dari halaman device
4. Isi variabel di `.env`:
   ```env
   FONNTE_WA_NUMBER=628xxxxxxxxxx
   FONNTE_API_TOKEN=token_dari_fonnte_dashboard
   ```
5. Jalankan seeder ulang agar setting tersimpan:
   ```bash
   php artisan db:seed --class=ChatbotSettingSeeder
   ```
6. Untuk testing di lokal, gunakan **Ngrok** sebagai tunnel:
   ```bash
   ngrok http 8000
   ```
7. Salin URL publik ngrok, lalu masukkan ke **Webhook URL** di Fonnte Dashboard:
   ```
   https://xxxx.ngrok-free.app/webhook/fonnte
   ```
8. Konfigurasi lanjut bisa diubah di **Admin Dashboard → Kelola Chatbot** (`/admin/chatbot`)

### Cara Kerja:
- User upload bukti pembayaran → redirect otomatis ke WhatsApp dengan pesan template
- Pesan dikirim ke nomor bot → Fonnte trigger webhook ke server
- Server deteksi keyword (`join member`, `bukti pembayaran`, dll.) → auto-reply dengan greeting dinamis (Pagi/Siang/Sore/Malam) sesuai waktu WIB

---

## Database Schema

```
users              — id_user, name, email, role, is_member, membership_tier
fields             — id_field, name, surface_type, is_active
field_prices       — id_field_price, field_id, day_type, start_time, end_time, price_regular, price_member
bookings           — id_booking, user_id, field_id, booking_date, start_time, end_time, total_price, status
payments           — id_payment, booking_id, payment_method, amount, status
membership_payments — id, user_id, payment_method, membership_tier, amount, status, payment_proof
vouchers           — id, code, name, type, value, is_active
member_notifications — id, user_id, title, message, type, is_read
chatbot_settings   — id, wa_number, api_token, user_message_template, reply_message_template, is_active
contact_messages   — id, name, email, subject, message, type, status
```

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/          — AdminDashboardController, UserController, VoucherController, ChatbotController
│   ├── Auth/           — Breeze auth controllers
│   ├── BookingController.php
│   ├── MemberPaymentController.php
│   └── ContactController.php
├── Models/             — User, Field, Booking, Payment, Voucher, ChatbotSetting, ...
└── Http/Middleware/    — AdminMiddleware, NoCacheMiddleware

resources/views/
├── home.blade.php      — Landing page
├── dashboard.blade.php — User dashboard
├── payment/            — member.blade.php, member-success.blade.php
├── bookings/           — create, show, index
└── admin/              — dashboard, bookings, messages, users/, vouchers/, chatbot/
```

---

## Environment Variables

Key yang perlu diset di `.env`:

```env
APP_NAME="BOA Futsal"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=boafutsalfinal
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_app_password

# WhatsApp Chatbot Fonnte
FONNTE_WA_NUMBER=628xxxxxxxxxx
FONNTE_API_TOKEN=your_fonnte_token
```

---

## License

MIT — bebas digunakan untuk keperluan edukasi dan pengembangan.
