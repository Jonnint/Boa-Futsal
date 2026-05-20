# BOA Futsal - Database Structure

## Tables Overview

### 1. users
User accounts (customers)

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Nama lengkap |
| email | string | Email (unique) |
| phone | string | Nomor telepon |
| password | string | Hashed password |
| is_member | boolean | Status member (default: false) |
| email_verified_at | timestamp | Email verification |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relationships:**
- hasMany: bookings

---

### 2. fields
Lapangan futsal

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Nama lapangan (BF 01, BF 02, BF 03) |
| description | text | Deskripsi lapangan |
| image | string | Path gambar |
| surface_type | string | Jenis rumput (default: Rumput Sintetis) |
| is_active | boolean | Status aktif (default: true) |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relationships:**
- hasMany: prices (FieldPrice)
- hasMany: bookings

---

### 3. field_prices
Harga lapangan berdasarkan hari & jam

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| field_id | bigint | Foreign key ke fields |
| day_type | enum | 'weekday' atau 'weekend' |
| start_time | time | Jam mulai (07:00, 12:00, 16:00) |
| end_time | time | Jam selesai (12:00, 16:00, 00:00) |
| price_regular | decimal(10,2) | Harga umum per jam |
| price_member | decimal(10,2) | Harga member per jam |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relationships:**
- belongsTo: field

**Pricing Logic:**
- Weekday (Senin-Jumat):
  - 07:00-12:00: Rp 65k (umum), Rp 260k (member/4x main)
  - 12:00-16:00: Rp 120k (umum), Rp 400k (member/4x main)
  - 16:00-00:00: Rp 130k (umum), Rp 400k (member/4x main)

- Weekend (Sabtu-Minggu):
  - 07:00-16:00: Rp 120k (umum), Rp 400k (member/4x main)
  - 16:00-00:00: Rp 130k (umum), Rp 400k (member/4x main)

---

### 4. bookings
Booking lapangan

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke users |
| field_id | bigint | Foreign key ke fields |
| booking_date | date | Tanggal booking |
| start_time | time | Jam mulai |
| end_time | time | Jam selesai |
| duration_hours | integer | Durasi dalam jam |
| price_per_hour | decimal(10,2) | Harga per jam yang dipakai |
| total_price | decimal(10,2) | Total harga (duration × price_per_hour) |
| is_member_price | boolean | Apakah pakai harga member |
| status | enum | 'pending', 'confirmed', 'cancelled', 'completed' |
| notes | text | Catatan tambahan |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relationships:**
- belongsTo: user
- belongsTo: field
- hasOne: payment

**Status Flow:**
- pending → confirmed → completed
- pending → cancelled

---

### 5. payments
Pembayaran booking

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| booking_id | bigint | Foreign key ke bookings |
| payment_method | enum | 'cash', 'transfer', 'qris' |
| amount | decimal(10,2) | Jumlah pembayaran |
| status | enum | 'pending', 'paid', 'failed' |
| proof_image | string | Path bukti transfer |
| paid_at | timestamp | Waktu pembayaran |
| notes | text | Catatan |
| created_at | timestamp | |
| updated_at | timestamp | |

**Relationships:**
- belongsTo: booking

---

## Seeded Data

### Fields (3 lapangan)
1. Lapangan BF 01
2. Lapangan BF 02
3. Lapangan BF 03

### Field Prices
Setiap lapangan punya 5 pricing rules:
- 2 untuk weekday (pagi, siang, malam)
- 2 untuk weekend (siang, malam)

Total: 15 price records (3 lapangan × 5 rules)

---

## Usage Examples

### Get field with prices
```php
$field = Field::with('prices')->find(1);
```

### Get user bookings
```php
$bookings = auth()->user()->bookings()->with('field', 'payment')->get();
```

### Check field availability
```php
$isAvailable = !Booking::where('field_id', $fieldId)
    ->where('booking_date', $date)
    ->where('status', '!=', 'cancelled')
    ->where(function($q) use ($startTime, $endTime) {
        $q->whereBetween('start_time', [$startTime, $endTime])
          ->orWhereBetween('end_time', [$startTime, $endTime]);
    })
    ->exists();
```

### Calculate price
```php
$price = FieldPrice::where('field_id', $fieldId)
    ->where('day_type', $dayType) // weekday or weekend
    ->where('start_time', '<=', $bookingTime)
    ->where('end_time', '>', $bookingTime)
    ->first();

$totalPrice = $price->price_regular * $durationHours;
// or
$totalPrice = $price->price_member * $durationHours;
```

---

## Next Steps

1. Implement booking form
2. Add validation for overlapping bookings
3. Create payment upload feature
4. Build admin dashboard for managing bookings
5. Add email notifications
