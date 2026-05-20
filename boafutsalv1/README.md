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
- **Komentar Publik** — pengunjung bisa meninggalkan komentar di halaman utama
- **Collab & Sponsorship** — form proposal yang masuk ke inbox admin
- **Admin Dashboard** — kelola booking, user, dan pesan masuk

---

## Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- SQLite atau MySQL

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

# 4. Setup database
touch database/database.sqlite   # untuk SQLite
php artisan migrate
php artisan db:seed

# 5. Build assets
npm run build

# 6. Jalankan server
php artisan serve
```

Atau pakai script setup otomatis:

```bash
composer run setup
php artisan serve
```

---

## Seeding

Seeder akan membuat:
- **Admin** — `admin@boafutsal.com` / `password`
- **3 Lapangan** — BF 01, BF 02, BF 03 dengan harga weekday/weekend

```bash
php artisan db:seed
```

---

## Database Schema

```
users           — id_user, name, email, role, is_member
fields          — id_field, name, surface_type, is_active
field_prices    — id_field_price, field_id, day_type, start_time, end_time, price_regular, price_member
bookings        — id_booking, user_id, field_id, booking_date, start_time, end_time, total_price, status
payments        — id_payment, booking_id, payment_method, amount, status
contact_messages — id, name, email, subject, message, type (general/collab), status
```

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/          — AdminDashboardController, UserController
│   ├── Auth/           — Breeze auth controllers
│   ├── BookingController.php
│   └── ContactController.php
├── Models/             — User, Field, FieldPrice, Booking, Payment, ContactMessage
└── Http/Middleware/    — AdminMiddleware, NoCacheMiddleware

resources/views/
├── home.blade.php      — Landing page
├── dashboard.blade.php — User dashboard
├── bookings/           — create, show, index
└── admin/              — dashboard, bookings, messages, users/
```

---

## Environment Variables

Key yang perlu diset di `.env`:

```env
APP_NAME="BOA Futsal"
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=boafutsal
# DB_USERNAME=root
# DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_app_password
```

---

## License

MIT — bebas digunakan untuk keperluan edukasi dan pengembangan.
