# LAPORAN STRUKTUR DATABASE
## Sistem Informasi Pemesanan Lapangan Futsal

---

## 1. Pendahuluan

Dokumen ini menjelaskan struktur database yang digunakan dalam sistem informasi pemesanan lapangan futsal. Database dirancang untuk mengelola data pengguna, lapangan, harga lapangan, pemesanan, dan pembayaran.

---

## 2. Daftar Tabel

| No | Nama Tabel      | Keterangan                                      |
|----|-----------------|--------------------------------------------------|
| 1  | users           | Data akun pengguna dan admin                    |
| 2  | fields          | Data lapangan futsal                            |
| 3  | field_prices    | Harga lapangan berdasarkan hari dan sesi waktu  |
| 4  | bookings        | Data pemesanan lapangan                         |
| 5  | payments        | Data pembayaran pemesanan                       |

---

## 3. Struktur Tabel

### 3.1 Tabel `users`

Menyimpan data akun pengguna yang terdaftar dalam sistem, termasuk pelanggan dan admin.

| No | Nama Kolom         | Tipe Data        | Keterangan                          |
|----|--------------------|------------------|--------------------------------------|
| 1  | id                 | BIGINT (PK)      | Primary key, auto increment          |
| 2  | name               | VARCHAR          | Nama lengkap pengguna                |
| 3  | email              | VARCHAR (UNIQUE) | Alamat email pengguna                |
| 4  | phone              | VARCHAR          | Nomor telepon pengguna               |
| 5  | password           | VARCHAR          | Password terenkripsi                 |
| 6  | role               | ENUM             | Peran: `user` atau `admin`           |
| 7  | is_member          | BOOLEAN          | Status keanggotaan (default: false)  |
| 8  | email_verified_at  | TIMESTAMP        | Waktu verifikasi email               |
| 9  | remember_token     | VARCHAR          | Token untuk fitur remember me        |
| 10 | created_at         | TIMESTAMP        | Waktu data dibuat                    |
| 11 | updated_at         | TIMESTAMP        | Waktu data diperbarui                |

**Relasi:**
- Memiliki banyak data pada tabel `bookings` (one-to-many)

---

### 3.2 Tabel `fields`

Menyimpan data lapangan futsal yang tersedia untuk dipesan.

| No | Nama Kolom   | Tipe Data   | Keterangan                                  |
|----|--------------|-------------|----------------------------------------------|
| 1  | id           | BIGINT (PK) | Primary key, auto increment                  |
| 2  | name         | VARCHAR     | Nama lapangan (contoh: BF 01, BF 02, BF 03) |
| 3  | description  | TEXT        | Deskripsi lapangan                           |
| 4  | image        | VARCHAR     | Path file gambar lapangan                    |
| 5  | surface_type | VARCHAR     | Jenis permukaan (default: Rumput Sintetis)   |
| 6  | is_active    | BOOLEAN     | Status ketersediaan lapangan (default: true) |
| 7  | created_at   | TIMESTAMP   | Waktu data dibuat                            |
| 8  | updated_at   | TIMESTAMP   | Waktu data diperbarui                        |

**Relasi:**
- Memiliki banyak data pada tabel `field_prices` (one-to-many)
- Memiliki banyak data pada tabel `bookings` (one-to-many)

---

### 3.3 Tabel `field_prices`

Menyimpan data harga sewa lapangan berdasarkan jenis hari dan sesi waktu.

| No | Nama Kolom    | Tipe Data      | Keterangan                                    |
|----|---------------|----------------|------------------------------------------------|
| 1  | id            | BIGINT (PK)    | Primary key, auto increment                    |
| 2  | field_id      | BIGINT (FK)    | Foreign key ke tabel `fields`                  |
| 3  | day_type      | ENUM           | Jenis hari: `weekday` atau `weekend`           |
| 4  | start_time    | TIME           | Jam mulai sesi                                 |
| 5  | end_time      | TIME           | Jam selesai sesi                               |
| 6  | price_regular | DECIMAL(10,2)  | Harga per jam untuk pelanggan umum             |
| 7  | price_member  | DECIMAL(10,2)  | Harga per jam untuk pelanggan member           |
| 8  | created_at    | TIMESTAMP      | Waktu data dibuat                              |
| 9  | updated_at    | TIMESTAMP      | Waktu data diperbarui                          |

**Relasi:**
- Dimiliki oleh satu data pada tabel `fields` (many-to-one)

---

### 3.4 Tabel `bookings`

Menyimpan data pemesanan lapangan yang dilakukan oleh pengguna.

| No | Nama Kolom      | Tipe Data      | Keterangan                                              |
|----|-----------------|----------------|----------------------------------------------------------|
| 1  | id              | BIGINT (PK)    | Primary key, auto increment                              |
| 2  | user_id         | BIGINT (FK)    | Foreign key ke tabel `users`                             |
| 3  | field_id        | BIGINT (FK)    | Foreign key ke tabel `fields`                            |
| 4  | booking_date    | DATE           | Tanggal pemesanan                                        |
| 5  | start_time      | TIME           | Jam mulai pemakaian lapangan                             |
| 6  | end_time        | TIME           | Jam selesai pemakaian lapangan                           |
| 7  | duration_hours  | INTEGER        | Durasi pemakaian dalam jam                               |
| 8  | price_per_hour  | DECIMAL(10,2)  | Harga per jam yang berlaku saat pemesanan                |
| 9  | total_price     | DECIMAL(10,2)  | Total harga (durasi × harga per jam)                     |
| 10 | is_member_price | BOOLEAN        | Penanda apakah menggunakan harga member (default: false) |
| 11 | status          | ENUM           | Status: `pending`, `confirmed`, `cancelled`, `completed` |
| 12 | notes           | TEXT           | Catatan tambahan dari pengguna                           |
| 13 | created_at      | TIMESTAMP      | Waktu data dibuat                                        |
| 14 | updated_at      | TIMESTAMP      | Waktu data diperbarui                                    |

**Relasi:**
- Dimiliki oleh satu data pada tabel `users` (many-to-one)
- Dimiliki oleh satu data pada tabel `fields` (many-to-one)
- Memiliki satu data pada tabel `payments` (one-to-one)

---

### 3.5 Tabel `payments`

Menyimpan data pembayaran yang terkait dengan setiap pemesanan lapangan.

| No | Nama Kolom      | Tipe Data      | Keterangan                                      |
|----|-----------------|----------------|--------------------------------------------------|
| 1  | id              | BIGINT (PK)    | Primary key, auto increment                      |
| 2  | booking_id      | BIGINT (FK)    | Foreign key ke tabel `bookings`                  |
| 3  | payment_method  | ENUM           | Metode: `cash`, `transfer`, atau `qris`          |
| 4  | amount          | DECIMAL(10,2)  | Jumlah nominal pembayaran                        |
| 5  | status          | ENUM           | Status: `pending`, `paid`, atau `failed`         |
| 6  | proof_image     | VARCHAR        | Path file bukti pembayaran (transfer/QRIS)       |
| 7  | paid_at         | TIMESTAMP      | Waktu pembayaran dikonfirmasi                    |
| 8  | notes           | TEXT           | Catatan tambahan terkait pembayaran              |
| 9  | created_at      | TIMESTAMP      | Waktu data dibuat                                |
| 10 | updated_at      | TIMESTAMP      | Waktu data diperbarui                            |

**Relasi:**
- Dimiliki oleh satu data pada tabel `bookings` (one-to-one)

---

## 4. Diagram Relasi Antar Tabel

```
users
  └──< bookings >──┐
                   ├── fields
                   │     └──< field_prices
                   └──── payments
```

| Relasi                        | Jenis        |
|-------------------------------|--------------|
| users → bookings              | One-to-Many  |
| fields → bookings             | One-to-Many  |
| fields → field_prices         | One-to-Many  |
| bookings → payments           | One-to-One   |

---

## 5. Keterangan Tambahan

### Aturan Harga (`field_prices`)

Harga lapangan dibedakan berdasarkan jenis hari dan sesi waktu:

| Jenis Hari          | Sesi Waktu    | Harga Umum | Harga Member |
|---------------------|---------------|------------|--------------|
| Weekday (Sen–Jum)   | 07:00–12:00   | Rp 65.000  | Rp 260.000   |
| Weekday (Sen–Jum)   | 12:00–16:00   | Rp 120.000 | Rp 400.000   |
| Weekday (Sen–Jum)   | 16:00–00:00   | Rp 130.000 | Rp 400.000   |
| Weekend (Sab–Min)   | 07:00–16:00   | Rp 120.000 | Rp 400.000   |
| Weekend (Sab–Min)   | 16:00–00:00   | Rp 130.000 | Rp 400.000   |

### Alur Status Pemesanan (`bookings.status`)

```
pending → confirmed → completed
pending → cancelled
```

### Metode Pembayaran (`payments.payment_method`)

- `cash` : Pembayaran tunai di tempat
- `transfer` : Transfer bank (disertai bukti)
- `qris` : Pembayaran via QRIS (disertai bukti)
