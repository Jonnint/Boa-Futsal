# PRD Addendum — Perluasan Editable Content Section ke Seluruh Halaman Publik
**Produk:** BOA Futsal Arena — Digital Booking Platform
**Versi Dokumen:** 2.2 (Keputusan arsitektur final + struktur Detail Booking dari kode asli)
**Tanggal:** 13 September 2026

### Update v2.2
| Topik | Keputusan |
|---|---|
| Arsitektur (Opsi A vs B) | ✅ **Final: Opsi B (Generic Content Block)** — dipilih atas rekomendasi, demi scalability ke client-client berikutnya. |
| Struktur Detail Booking (`show.blade.php`) | Dipetakan dari kode asli (`BookingController@show`, route `bookings.show`) — hampir seluruh isi halaman **transaksional** (status, info pemesan, jadwal sewa, rincian pembayaran, kode booking). Scope editable dipersempit ke header/branding + footer/CTA saja. |
| Permission | ✅ **Final: Admin biasa DAN Developer sama-sama bisa mengedit konten** di semua halaman baru (Sejarah, Cara Booking, Booking, Detail Booking, Login/Register branding) — bukan dibatasi ke Developer saja. |
| Sejarah — struktur body | Belum dijawab eksplisit — diasumsikan **paragraf bebas (rich text) + 1 gambar profil venue**, opsi paling sederhana. Lihat catatan di Section 6. |

### Update v2.1
| Topik | Keputusan |
|---|---|
| Login & Register | Ikut sport type aktif **hanya di bagian branding** (logo, judul/welcome text, background image) — bukan full konten. |
| Detail Harga ("Rincian Harga") | Bukan halaman/section content baru — ini komponen yang murni derivatif dari data `Field` & `FieldPrice` yang **sudah otomatis ter-scope** ke sport type aktif lewat relasi yang dibangun di v1.2. Muncul di 2 tempat: inline di form booking, dan modal popup `#fields` di homepage. Ditambahkan sebagai **technical requirement** (bukan content-editor baru) — lihat Section 4.4. |

---

## 0. Status Implementasi Saat Ini (Rekap dari 29 Commit)

Berdasarkan commit yang sudah di-push, ini kondisi real sekarang:

| Bagian | Status |
|---|---|
| Skema DB (`sport_types`, `sport_type_galleries`, `sport_type_switch_logs`), Models, Middleware `EnsureDeveloperRole`, Seeder | ✅ Selesai |
| `ActiveSportTypeComposer` (inject sport type aktif ke semua view) | ✅ Selesai |
| `ArchiveGalleryService`, `BookingMessageService` (pesan dinamis dari snapshot) | ✅ Selesai |
| Dashboard admin: menu "Switch Sport Type", list + switch live + riwayat log, form create/edit profil | ✅ Selesai |
| **Home (`home.blade.php`)** | ✅ **Konten dinamis penuh per section** (hero, fasilitas, dst mengikuti sport type aktif) |
| **Sejarah (`sejarah.blade.php`)** | ⚠️ **Baru judul halaman** yang ikut sport type aktif — isi cerita/body masih statis |
| **Cara Booking (`cara-booking.blade.php`)** | ⚠️ **Baru judul halaman** yang ikut sport type aktif — isi langkah-langkah masih statis |
| **Halaman Booking (form/listing lapangan)** | ❌ Belum ada konten dinamis — baru isolasi data lapangan aktif (`BookingController`) & simpan snapshot |
| **Detail Booking / Invoice** | ❌ Belum ada konten dinamis sama sekali |

**Kesimpulan gap:** mekanisme *edit per section dari dashboard developer* baru benar-benar lengkap di Home. Permintaan sekarang adalah melengkapi pola yang sama ke **Sejarah, Cara Booking (full body, bukan cuma judul), Halaman Booking, dan Detail Booking**.

---

## 1. Tujuan (Goals)

1. Setiap halaman yang dilihat & dipakai pengunjung (Home, Sejarah, Cara Booking, Booking, Detail Booking) punya konten yang bisa diedit per section dari dashboard developer/admin — konsisten dengan pola yang sudah jalan di Home.
2. Pemisahan yang jelas antara **konten editable** (copy/teks/gambar milik Sport Type — bisa diedit) vs **data transaksional** (nama lapangan yang dibooking, harga, jam, status pembayaran — tetap dari database booking, TIDAK ikut sistem konten ini).
3. Arsitektur yang dipilih harus **scalable** — mengingat tujuan platform ini memang untuk dipakai berulang ke banyak calon client (bukan sekali pakai), jadi menambah halaman baru di masa depan idealnya tidak butuh migrasi skema tiap kali.

---

## 2. Cakupan per Halaman (Draft — perlu konfirmasi di Section 6)

| Halaman | Kemungkinan Section yang Perlu Editable |
|---|---|
| **Sejarah** | Body cerita/profil venue (bukan cuma judul), foto profil venue, opsional: daftar pencapaian/milestone |
| **Cara Booking** | Daftar langkah-langkah (step 1, 2, 3, ...) beserta judul, deskripsi, dan ikon/gambar tiap langkah — bukan cuma judul halaman |
| **Halaman Booking (listing & form)** | Teks banner/intro atas halaman, catatan kebijakan (misal aturan DP/pembatalan), label/badge teks, teks CTA |
| **Detail Booking / Invoice** (`bookings/show.blade.php`) | ✅ Dipetakan dari kode asli — lihat rincian di Section 4.6. Ringkas: hampir semua isi **transaksional** (status, info pemesan, jadwal sewa, rincian pembayaran, kode booking) — bagian yang benar-benar editable cuma header/branding & footer/CTA. |
| **Login & Register** | ✅ Terkonfirmasi — **hanya branding**: logo, judul/welcome text, background image. Bukan full konten. |
| **Detail Harga / "Rincian Harga"** (inline form booking + modal `#fields` di home) | ✅ Terkonfirmasi via screenshot — **bukan content section baru**, murni data `Field`+`FieldPrice` yang sudah otomatis ikut sport type aktif. Perlu technical check konsistensi query di 2 lokasi (lihat Section 4.4). |

> ⚠️ Baris Sejarah, Cara Booking, Booking (banner/kebijakan), dan Detail Booking di atas masih **asumsi berdasarkan pola umum booking app** — karena saya belum bisa mengakses langsung isi `bookings/*.blade.php` di repo (GitHub memblokir automated fetch). Supaya PRD ini presisi 100% sesuai kode yang sudah ada, akan lebih akurat kalau bagian teks statis yang ada di file `booking` & `detail booking` saat ini di-paste/dilampirkan — biar section-section-nya dipetakan sesuai teks yang benar-benar ada, bukan tebakan.

---

## 3. Keputusan Arsitektur — ✅ FINAL: Opsi B (Generic Content Block)

Setelah dipertimbangkan, dipilih **Opsi B** — alasan utamanya karena platform ini memang didesain untuk dipakai berulang ke banyak calon client ke depan, jadi investasi effort di awal untuk arsitektur yang scalable lebih masuk akal daripada tambal-sulam per halaman.

### Opsi A — Tambal Cepat *(tidak dipilih)*
- Tambah tabel/kolom baru khusus per halaman, meniru pola `sport_types` yang sudah ada untuk Home.
- Lebih cepat tapi tidak scalable — setiap halaman baru ke depan butuh migrasi tabel baru lagi.

### Opsi B — Generic Content Block ✅ *(dipilih)*
- Satu tabel generik `sport_type_page_sections`:

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| sport_type_id | FK → sport_types | |
| page_key | string (enum-like) | `home`, `sejarah`, `cara_booking`, `booking`, `booking_detail` |
| section_key | string | contoh: `hero`, `step_1`, `policy_note` — unik per kombinasi page+sport type |
| label | string | nama section yang tampil di form admin (biar developer paham ini section apa) |
| content_type | enum | `text`, `richtext`, `image`, `list_item` |
| content_value | text/json, nullable | isi teks atau JSON untuk list |
| image_path | string, nullable | |
| order | integer, default 0 | |
| created_at/updated_at | timestamp | |

- Halaman baru di masa depan **tidak butuh migrasi skema** — cukup daftarkan `page_key` & `section_key` baru dari seeder/konfigurasi, form admin otomatis mengikuti.
- **Kelebihan:** Scalable, satu sistem untuk semua halaman termasuk yang akan datang.
- **Kekurangan:** Butuh effort tambahan untuk **migrasi konten Home yang sudah live** dari kolom `sport_types` (`hero_title`, `facilities`, dst) ke struktur generik ini — supaya konsisten satu sistem, bukan dua sistem berbeda (kolom khusus utk Home + tabel generik utk halaman lain).

> **Catatan implementasi:** migrasi Home dilakukan hati-hati (data existing di-backfill ke `sport_type_page_sections` via seeder/command, lalu kolom lama di `sport_types` dipertahankan dulu sebagai fallback sebelum benar-benar dihapus, untuk jaga-jaga ada bug saat transisi).

---

## 4. Functional Requirements

### 4.1 Admin/Developer — Kelola Konten per Halaman
- Menu "Kelola Konten Sport" di sidebar diperluas jadi tab per halaman: **Home | Sejarah | Cara Booking | Booking | Detail Booking**.
- Tiap tab menampilkan daftar section sesuai `page_key`, form edit sesuai `content_type` (text biasa, rich text, upload gambar, atau list berulang seperti langkah-langkah Cara Booking).
- ✅ **Permission final:** mengedit konten boleh untuk **role `admin` maupun `developer`** — sama seperti pola Home, berlaku konsisten untuk semua halaman baru. Yang tetap eksklusif untuk `developer` hanya **switch aktif** dan **hapus Sport Type** (Section 6.2 di PRD utama v1.2), bukan pengeditan konten.

### 4.2 Rendering di Halaman Publik
- `sejarah.blade.php`, `cara-booking.blade.php` mengambil isi body/step dari `sport_type_page_sections` sesuai `page_key` masing-masing, bukan lagi hardcode.
- `bookings/*.blade.php` (listing, form, detail/invoice) mengambil teks banner/kebijakan/CTA dari section yang sesuai, **sambil tetap menampilkan data transaksi apa adanya dari record `Booking`/`Field`/`Payment`** — tidak boleh tercampur.

### 4.3 Konsistensi dengan Live Switch
- Karena section ini ikut `sport_type_id`, begitu `developer` switch aktif, seluruh halaman (termasuk Booking & Detail Booking) otomatis ikut berubah konten — sama seperti behavior Home saat ini, tanpa preview (sesuai keputusan final v1.2).

### 4.4 Detail Harga / "Rincian Harga" — Technical Check (Bukan Content Baru)
- Komponen ini (contoh: box "Rincian Harga" di form booking, dan modal popup saat klik lapangan di homepage) **tidak butuh sistem content-editor baru** — datanya sudah otomatis benar selama query Field-nya konsisten pakai scope `Field::activeSportType()`.
- **Yang perlu dipastikan (regression check):** modal `#fields` di `home.blade.php` dan komponen "Rincian Harga" di `bookings/create.blade.php` menggunakan **query/scope yang sama persis** — supaya tidak ada risiko salah satu tempat lupa difilter dan tetap menampilkan harga lapangan dari sport type yang sedang nonaktif.
- Label struktural seperti "SENIN – JUMAT", "SABTU – MINGGU", "SESI PAGI/SIANG/SORE" tetap system-generated dari data hari/jam di `FieldPrice`, bukan teks bebas yang perlu diedit manual per sport type.

### 4.5 Login & Register — Branding Only
- `guest.blade.php` (layout untuk login/register) menampilkan: logo, judul/welcome text, dan background image sesuai Active Sport Type.
- Field ini bisa memakai kolom yang **sudah ada** di `sport_types` (`hero_image_path` bisa dipakai ulang sebagai background, atau tambah kolom baru `auth_background_path` jika perlu beda dari hero Home) + `name`/`hero_title` untuk welcome text — **tidak perlu tabel/section baru**, cukup extend query `ActiveSportTypeComposer` agar juga di-share ke layout `guest.blade.php`.
- Tidak ada perubahan pada logika autentikasi itu sendiri (validasi login, registrasi, reset password tetap standar Laravel, tidak disentuh).

### 4.6 Detail Booking (`bookings/show.blade.php`) — Pemetaan dari Kode Asli

Berdasarkan struktur nyata yang sudah ada:

```php
// BookingController.php baris 185–195
public function show($id)
{
    $booking = Booking::with(['field', 'payment'])->findOrFail($id);
    if ($booking->user_id && Auth::check() && $booking->user_id !== Auth::id()) {
        abort(403);
    }
    return view('bookings.show', compact('booking'));
}
```
Route: `GET /bookings/{booking}` → `bookings.show` (`web.php` baris 96)

Isi halaman ini terbagi jadi 2 kategori:

| Kategori | Bagian | Sumber Data | Ikut Sistem Content? |
|---|---|---|---|
| **Transaksional (TIDAK diedit lewat content system)** | Status Booking (Menunggu Konfirmasi/Dikonfirmasi/Selesai/Dibatalkan) | Kolom status di `Booking` | ❌ Tetap dari DB |
| | Informasi Pemesan (Nama, Email, No. Telepon) | Relasi `Booking` → `User` | ❌ Tetap dari DB |
| | Jadwal Sewa (Nama Lapangan, Tanggal, Jam, Durasi) | Relasi `Booking` → `Field` + snapshot (v1.2) | ❌ Tetap dari DB |
| | Rincian Pembayaran (tarif/jam, potongan voucher/diskon, total) | Relasi `Booking` → `Payment` | ❌ Tetap dari DB |
| | Kode Booking (`id_booking`) | Web: `str_pad($booking->id_booking, 6, '0', STR_PAD_LEFT)` → `#000005`. WA: raw `#{$booking->id_booking}` → `#5` | ❌ Format tetap seperti sekarang, tidak diubah |
| **Content (ikut sistem `sport_type_page_sections`, `page_key = booking_detail`)** | Judul/header halaman (mis. "Detail Booking" bisa jadi "Detail Reservasi Padel") | `section_key = header_title` | ✅ Editable |
| | Catatan kaki / kebijakan (mis. syarat pembatalan) | `section_key = footer_note` | ✅ Editable |
| | Teks CTA follow-up WhatsApp (mis. "Ada kendala? Hubungi kami") | `section_key = wa_cta_text` | ✅ Editable |

**Kesimpulan:** halaman ini **tetap masuk** ke sistem editable content sesuai yang diminta ("beneran kayak halaman itu bisa diedit"), tapi cakupannya presisi hanya di 3 section di atas — bukan seluruh isi struk, karena sisanya memang harus tetap murni data transaksi supaya invoice tidak bisa "disunting" isinya oleh admin/developer (data integrity).

---

## 5. Non-Functional Requirements

- **Tidak boleh regresi ke Home** yang sudah live — jika Opsi B dipilih, migrasi data Home harus disertai QA regresi penuh sebelum kolom lama dihapus.
- **Pemisahan tegas** antara "konten" (editable) dan "data transaksi" (read-only dari DB booking) di level Blade template, supaya tidak ada risiko developer tidak sengaja bikin harga/jam booking jadi "editable text" yang bisa disalahgunakan.
- Validasi panjang teks untuk section yang tampil di area sempit UI (misal badge/label di booking form) — supaya tidak merusak layout kalau developer isi teks terlalu panjang.

---

## 6. Status Pertanyaan Terbuka

| # | Pertanyaan | Status |
|---|---|---|
| 1 | Opsi A atau B? | ✅ **Resolved** — Opsi B (Generic Content Block) |
| 2 | Section detail di Detail Booking? | ✅ **Resolved** — dipetakan dari kode asli, lihat Section 4.6 |
| 3 | Sejarah — paragraf bebas atau struktur timeline? | ⚠️ **Belum dijawab eksplisit.** Untuk sementara diasumsikan **paragraf bebas (rich text) + 1 gambar profil venue** sebagai default paling sederhana (`section_key`: `body_text`, `profile_image`). Kalau ternyata butuh struktur timeline/pencapaian per tahun, tinggal kabari — tinggal tambah `section_key` baru seperti `milestone_list` (content_type `list_item`), tidak perlu ubah arsitektur karena sudah pakai Opsi B yang generic. |
| 4 | Permission halaman baru? | ✅ **Resolved** — Admin biasa & Developer sama-sama bisa edit konten (Section 4.1) |

---

## 7. Rencana Rilis (Lanjutan dari Fase 8 sebelumnya)

| Fase | Cakupan |
|---|---|
| **Fase 9** | Migrasi skema `sport_type_page_sections` + backfill konten Home existing dari kolom lama di `sport_types` + regresi penuh Home |
| **Fase 10** | Buat section content untuk Sejarah (body + gambar profil, default rich text) & Cara Booking (full steps, bukan cuma judul) |
| **Fase 11** | Buat section content untuk Halaman Booking (banner, kebijakan, CTA) — dengan pemisahan tegas dari data transaksi & Rincian Harga (technical check Section 4.4) |
| **Fase 12** | Buat section content untuk Detail Booking sesuai pemetaan Section 4.6 (header, footer, WA CTA saja) |
| **Fase 13** | Extend `ActiveSportTypeComposer` ke `guest.blade.php` untuk branding Login/Register |
| **Fase 14** | Perluas UI dashboard "Kelola Konten Sport" jadi multi-tab per halaman, dengan permission Admin + Developer |
| **Fase 15** | QA regresi penuh seluruh halaman + uji live switch end-to-end di semua halaman sekaligus |

---

## 8. Success Metrics

- `developer` bisa switch sport type dan **seluruh 5 halaman** (Home, Sejarah, Cara Booking, Booking, Detail Booking) berubah konsisten — tidak ada lagi halaman yang "ketinggalan" konten lama.
- 0 kebocoran data transaksi tercampur jadi konten yang bisa diedit sembarangan.
- 0 regresi terhadap fitur Home yang sudah live saat ini.
