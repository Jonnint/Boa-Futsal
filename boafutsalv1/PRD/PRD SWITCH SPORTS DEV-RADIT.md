# PRD — Sport Type Switcher (Multi-Olahraga Content Switching)
**Produk:** BOA Futsal Arena — Digital Booking Platform
**Versi Dokumen:** 1.2 (Final — seluruh pertanyaan terbuka terjawab)
**Tanggal:** 12 September 2026

---

## 0. Ringkasan Seluruh Keputusan

| # | Topik | Keputusan Final |
|---|---|---|
| 1 | Tujuan fitur | Tool development/sales-enablement — dipakai pitching ke calon client, lalu profil yang tidak jadi dipakai **dihapus** dari sistem. |
| 2 | Visibilitas | Saat satu Sport Type aktif, semua Sport Type lain **full hidden** dari publik (termasuk via direct URL). |
| 3 | Chatbot WhatsApp | Nomor tujuan tetap sama; **isi pesan** menyesuaikan lapangan/sport type dari booking terkait (via snapshot, bukan status aktif situs saat pesan dikirim). |
| 4 | Voucher & Promo | **Tidak disentuh** — tetap global seperti sistem sekarang. |
| 5 | Role & Permission | Role baru bernama **`developer`**, satu-satunya yang bisa switch aktif/hapus Sport Type. |
| 6 | Mode Preview | **Tidak ada preview/staging.** Begitu `developer` klik switch dan balik ke halaman utama, konten sudah langsung live berubah — real-time, tanpa tahap staging terpisah. |
| 7 | Penamaan role | Final: **`developer`** (bukan `super_admin`). |
| 8 | Penghapusan galeri | **Tidak hard-delete langsung.** File & record galeri dipindah ke **folder arsip** saat Sport Type dihapus — bukan dihapus permanen, untuk jaga-jaga bisa dipakai lagi ke depan. |

Seluruh section di bawah sudah menyesuaikan 8 keputusan final di atas. Dokumen ini sudah bisa jadi acuan estimasi & development.

---

## 1. Latar Belakang

Platform booking BOA Futsal Arena dibangun di atas Laravel 12 (Monolith MVC), frontend Blade + Tailwind + Alpine.js yang desainnya **final dan tidak diubah**.

Fitur ini dibutuhkan untuk kebutuhan **development & sales**: saat proses pitching ke calon client, tim ingin menunjukkan bagaimana platform yang sama bisa "berganti wajah" jadi Futsal, Padel, atau Badminton hanya lewat toggle dari dashboard — tanpa develop ulang dari nol tiap kali ada calon client dengan jenis olahraga berbeda.

Begitu client sudah fix pilih satu jenis olahraga, Sport Type lain yang tidak jadi dipakai akan **dihapus** dari sistem produksi client tersebut (kontennya, bukan foto-fotonya — foto diarsipkan, lihat Section 6.2).

Switch bersifat **langsung live**, tanpa mode preview — begitu `developer` menekan tombol aktifkan dan kembali ke halaman utama publik, konten yang tampil sudah 100% konten Sport Type yang baru dipilih.

---

## 2. Tujuan (Goals)

1. Tim development bisa menyiapkan & mendemokan beberapa profil olahraga dalam satu codebase yang sama ke calon client, dengan hasil switch yang **langsung terlihat live** saat itu juga.
2. Satu tombol switch membuat seluruh halaman publik (home, cara booking, sejarah, listing lapangan, form booking, dan isi pesan WhatsApp) menyesuaikan Sport Type yang aktif — Sport Type lain **full disembunyikan**.
3. Tersedia mekanisme **hapus Sport Type** yang tidak jadi dipakai, dengan galeri foto **diarsipkan** (bukan dihapus permanen) sebagai bagian dari proses finalisasi sebelum go-live ke client.
4. Alur teknis booking, payment, voucher, dan notifikasi WhatsApp **tidak mengalami perubahan logika** — hanya sumber konten & isi pesan yang menyesuaikan konteks.
5. Hanya role **`developer`** yang boleh switch atau menghapus Sport Type — Admin biasa tidak diberi akses ke dua aksi ini.

---

## 3. Non-Goals (Di Luar Cakupan)

- Tidak ada mode preview/staging — final dikonfirmasi: switch bersifat langsung live.
- Tidak membuat visitor memilih sendiri jenis olahraga di frontend.
- Tidak mengubah desain dasar/struktur komponen UI — hanya konten dinamis.
- Tidak menyentuh sistem voucher/promo — tetap 100% seperti implementasi sekarang.
- Tidak mengubah nomor tujuan WhatsApp atau mekanisme pengiriman chatbot — hanya template isi pesannya.

---

## 4. Definisi Istilah

| Istilah | Arti |
|---|---|
| **Sport Type** | Profil olahraga (Futsal / Padel / Badminton / dst) berisi konten & lapangan miliknya sendiri |
| **Active Sport Type** | Sport Type yang sedang tampil ke publik (hanya 1 aktif, sisanya hidden total) |
| **`developer`** | Role baru, satu-satunya yang bisa switch & hapus Sport Type |
| **Finalisasi** | Proses menghapus Sport Type yang tidak jadi dipakai client, dengan galeri yang diarsipkan |
| **Arsip Galeri** | Folder/storage terpisah tempat foto Sport Type yang dihapus dipindahkan, tidak lagi publik tapi tidak hilang permanen |

---

## 5. User Stories

1. **Sebagai tim development**, saya menyiapkan 3 profil (Futsal, Padel, Badminton), lalu mendemokan tiap profil ke calon client dengan tombol switch yang hasilnya langsung terlihat live di halaman utama.
2. **Sebagai `developer`**, saya mengaktifkan satu profil dan begitu saya buka halaman utama publik, kontennya sudah berubah total — tanpa perlu tahap approve/preview tambahan.
3. **Sebagai `developer`**, setelah client memutuskan pakai Padel, saya menghapus profil Futsal & Badminton — foto-fotonya otomatis pindah ke folder arsip, bukan hilang permanen, kalau-kalau suatu saat perlu dipakai lagi (misal client lain minta konsep serupa).
4. **Sebagai Admin biasa (bukan `developer`)**, saya tetap bisa mengelola isi konten Sport Type (teks, foto, harga), tapi tombol switch & hapus tidak bisa saya akses.
5. **Sebagai pengunjung website**, saya booking & menerima WhatsApp konfirmasi seperti biasa, dengan isi pesan yang otomatis menyebut jenis lapangan yang benar sesuai transaksi saya — meskipun sport type situs sudah berganti setelahnya.

---

## 6. Functional Requirements

### 6.1 Manajemen Sport Type (Semua Level Admin)
- CRUD Sport Type: nama, slug, hero title/subtitle, deskripsi, gambar hero, galeri foto (multiple), daftar fasilitas, meta title/description.
- Semua Admin bisa mengelola isi konten Sport Type manapun.
- Hanya satu Sport Type aktif dalam satu waktu (radio-exclusive).

### 6.2 Switch & Hapus Sport Type (Khusus Role `developer`)
- Tombol **"Jadikan Aktif"** hanya bisa ditekan oleh role `developer`. Admin biasa melihat tombol ini dalam kondisi disabled + tooltip.
- Begitu ditekan (setelah dialog konfirmasi), sistem langsung **flush cache** Active Sport Type — perubahan tampil live di halaman publik tanpa delay/tahap approval, sesuai keputusan final (tidak ada preview).
- Validasi: tidak bisa aktifkan Sport Type yang belum punya minimal 1 lapangan dengan harga terisi.
- Tombol **"Hapus Sport Type"** (fitur finalisasi), khusus `developer`:
  - Tidak bisa menghapus Sport Type yang sedang aktif.
  - Sebelum hapus, tampilkan ringkasan: jumlah lapangan, jumlah foto galeri, jumlah booking historis terkait.
  - **Proses hapus:**
    1. Record `Sport Type` & `Field` terkait dihapus dari tabel aktif (atau soft-delete, lihat Section 8).
    2. **File & record galeri (`sport_type_galleries`) TIDAK dihapus** — dipindahkan ke folder arsip (`storage/app/archived-galleries/{sport_type_slug}-{timestamp}/`) dan ditandai `archived_at`.
    3. Data booking historis tidak ikut terhapus — snapshot tetap utuh (Section 6.5).
  - Aksi hapus dicatat di audit log.

### 6.3 Manajemen Lapangan per Sport Type
- Field memiliki relasi `sport_type_id`.
- Halaman kelola lapangan difilter per Sport Type — bisa diakses semua level Admin.
- Struktur harga (`FieldPrice`) tidak berubah.

### 6.4 Rendering Frontend — Visibilitas Total & Live Switch
- Saat Sport Type A aktif, Sport Type B/C tidak bisa diakses sama sekali dari publik, termasuk via direct URL.
- Perubahan bersifat **real-time** — begitu `developer` switch dan reload halaman utama, konten baru langsung tampil (tidak ada jeda build/deploy/approval).
- `home.blade.php`, `cara-booking.blade.php`, `sejarah.blade.php`, dan halaman booking mengambil konten dari Active Sport Type.
- Endpoint `/api/field-schedule`, `/api/field-status` hanya mengembalikan lapangan milik Active Sport Type; request ke lapangan non-aktif → 404.

### 6.5 Integritas Data Historis (Snapshot)
- Setiap `Booking` menyimpan snapshot: `sport_type_name_snapshot`, `field_name_snapshot` — diisi saat create, permanen.
- Ini membuat proses hapus Sport Type (Section 6.2) aman tanpa merusak riwayat transaksi/invoice.

### 6.6 Chatbot WhatsApp — Konten Dinamis, Nomor Tetap
- `ChatbotSetting` tidak berubah untuk nomor tujuan (Fonnte tetap sama).
- Template pesan diberi placeholder dinamis:
  `"Booking Anda di {nama_lapangan} ({jenis_olahraga}) pada {tanggal} jam {jam} sudah dikonfirmasi."`
- Placeholder diisi dari **snapshot booking** (Section 6.5), bukan dari Active Sport Type saat pesan dikirim — supaya pesan follow-up booking lama tetap konsisten meski situs sudah switch/hapus sport type lain.

### 6.7 Voucher & Promo — Tidak Berubah
- `VoucherController`, model `Voucher`, `VoucherUsage` tidak disentuh, tetap global seperti implementasi sekarang.

---

## 7. Role & Permission

| Role | Kelola Konten Sport Type | Kelola Lapangan | Switch Aktif | Hapus Sport Type |
|---|---|---|---|---|
| `user` | ❌ | ❌ | ❌ | ❌ |
| `admin` (existing) | ✅ | ✅ | ❌ | ❌ |
| `developer` (baru) | ✅ | ✅ | ✅ | ✅ |

**Implementasi teknis:**
- Extend kolom `role` pada tabel `users` untuk menerima nilai baru `developer`.
- Middleware baru `EnsureDeveloperRole` memproteksi route `activate` dan `destroy` pada `SportTypeController` — validasi di level server, bukan hanya UI, agar tidak bisa dibypass lewat request langsung.
- Di sidebar admin, tombol "Jadikan Aktif" & "Hapus" tetap terlihat untuk transparansi tapi disabled untuk Admin biasa, dengan tooltip: *"Hanya role Developer yang bisa mengubah status ini."*

---

## 8. Perubahan Skema Database

**Tabel baru: `sport_types`**

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| name | string | "Futsal", "Padel", "Badminton" |
| slug | string, unique | |
| hero_title | string | |
| hero_subtitle | string, nullable | |
| description | text, nullable | |
| hero_image_path | string, nullable | |
| facilities | json, nullable | |
| meta_title / meta_description | string, nullable | |
| is_active | boolean, default false | hanya satu row `true` |
| created_at / updated_at | timestamp | |

**Tabel baru: `sport_type_galleries`**

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint PK | |
| sport_type_id | FK, nullable | nullable karena tetap harus bisa "yatim" saat parent dihapus tapi record galeri masih ada di arsip |
| image_path | string | path aktif SELAMA belum diarsipkan |
| archived_path | string, nullable | path baru di folder arsip setelah dihapus |
| caption | string, nullable | |
| order | integer, default 0 | |
| archived_at | timestamp, nullable | diisi saat Sport Type dihapus — jika `null` berarti masih aktif dipakai |

**Perubahan tabel `fields`:**
- Tambah `sport_type_id` (FK → sport_types, nullable, backfill ke Futsal saat migrasi awal, `onDelete('set null')`).

**Perubahan tabel `bookings`:**
- Tambah `sport_type_name_snapshot`, `field_name_snapshot` (string) — diisi sekali saat create, immutable.

**Perubahan tabel `users`:**
- Update kolom `role` untuk menampung nilai baru `developer`.

**Tabel baru: `sport_type_switch_logs`**
`id, user_id (FK users), from_sport_type_id, to_sport_type_id, action (activate/delete), created_at`

**Perubahan `chatbot_settings` / template pesan:**
- Template pesan mendukung placeholder `{nama_lapangan}`, `{jenis_olahraga}`, `{tanggal}`, `{jam}`. Tidak ada perubahan kolom nomor tujuan.

---

## 9. Perubahan Arsitektur Aplikasi

- **`SportTypeController` (Admin)**: `index`, `store`, `update` (semua Admin) + `activate`, `destroy` (khusus, digated middleware `EnsureDeveloperRole`).
- **`ArchiveGalleryService`**: service baru yang menangani pemindahan file fisik galeri ke folder arsip (`storage/app/archived-galleries/...`) dan update `archived_path` + `archived_at` saat `destroy` dipanggil — dijalankan sinkron atau via queue job agar tidak memblokir response jika jumlah file banyak.
- **View Composer** (`ActiveSportTypeComposer`): menyuntik `$activeSportType` ke semua view publik, dengan cache yang di-flush otomatis saat switch — memastikan perubahan **langsung live** sesuai keputusan final (tanpa preview).
- **Field scope**: `Field::activeSportType()` — dipakai di listing publik & API jadwal; request lapangan non-aktif → 404.
- **Notification/Chatbot service** (`BuildBookingMessage`): mengambil data dari snapshot booking, bukan dari Active Sport Type global.
- **Middleware baru**: `EnsureDeveloperRole` untuk route `activate` & `destroy`.

---

## 10. Perubahan UI Admin Dashboard

```
🏟️ Jenis Olahraga
   ├── Kelola Konten Sport        → semua Admin
   ├── Kelola Lapangan            → semua Admin (filter per sport type)
   └── Status & Switch Aktif      → tombol Switch/Hapus hanya enabled utk role Developer
```

Halaman "Status & Switch Aktif" menampilkan kartu tiap Sport Type dengan badge **AKTIF**, tombol **Jadikan Aktif** dan **Hapus** (warna berbeda untuk aksi destruktif), ringkasan jumlah lapangan/galeri/booking historis sebelum konfirmasi hapus, dan indikator kecil *"Perubahan akan langsung tampil live ke publik"* di dialog konfirmasi switch — supaya `developer` sadar tidak ada tahap preview.

---

## 11. Edge Cases & Risiko

| Kasus | Penanganan |
|---|---|
| `developer` mencoba hapus Sport Type yang sedang aktif | Ditolak sistem, harus pindah aktif dulu |
| Ada booking historis terkait Sport Type yang dihapus | Aman — snapshot booking tetap utuh, FK di-set NULL |
| Sport Type baru belum punya lapangan | Tombol "Jadikan Aktif" disabled + pesan validasi |
| Admin biasa mencoba akses endpoint switch/hapus langsung (bukan lewat UI) | Diblokir middleware `EnsureDeveloperRole` di server, respons 403 |
| Galeri yang sudah diarsipkan ingin dipakai lagi di Sport Type baru | Di luar cakupan versi ini — proses restore galeri arsip manual oleh developer (copy file), tidak ada UI restore otomatis di v1 |
| Pesan WhatsApp untuk booking lama terkirim setelah sport type diganti/dihapus | Aman — isi pesan dari snapshot booking |
| Volume galeri besar saat proses hapus (banyak foto) | Pemindahan file dilakukan via queue job agar tidak timeout di request HTTP |

---

## 12. Asumsi

1. Role `developer` bersifat tambahan di atas `admin` existing; minimal 1 akun `developer` harus ada saat migrasi (kemungkinan akun tim dev/owner).
2. Proses hapus bersifat hard-delete untuk record `Sport Type` & `Field` di tabel aktif, tapi **galeri (file + record) diarsipkan, tidak dihapus permanen**, sesuai keputusan final.
3. Tidak ada UI restore otomatis dari arsip di versi ini — jika suatu saat perlu dipakai ulang, dilakukan manual oleh tim development.
4. Nomor WhatsApp tujuan tetap satu untuk semua Sport Type.

---

## 13. Rencana Rilis (Phasing)

| Fase | Cakupan |
|---|---|
| **Fase 1** | Migrasi skema DB baru + role `developer` + seeding Futsal sebagai default aktif |
| **Fase 2** | CRUD Sport Type & Kelola Konten (semua Admin) |
| **Fase 3** | View Composer + integrasi frontend dinamis (home, cara-booking, sejarah), cache flush utk live switch |
| **Fase 4** | Filter Lapangan & API booking mengikuti Active Sport Type + visibilitas total (404 utk non-aktif) |
| **Fase 5** | Mekanisme Switch + middleware `EnsureDeveloperRole` + audit log |
| **Fase 6** | Template chatbot dinamis berbasis snapshot booking |
| **Fase 7** | Mekanisme Hapus/Finalisasi + `ArchiveGalleryService` (pemindahan file ke folder arsip) |
| **Fase 8** | QA regresi penuh (booking, payment, voucher, chatbot) → UAT → Go-live per client |

---

## 14. Success Metrics

- `developer` bisa switch demo dari satu sport type ke sport type lain **< 5 menit**, dan hasilnya **langsung terlihat live** tanpa tahap approval tambahan.
- Proses finalisasi (hapus sport type yang tidak jadi dipakai) berjalan tanpa downtime, tanpa merusak data historis, dan foto galeri aman tersimpan di folder arsip (tidak hilang).
- 0 kebocoran akses — Sport Type non-aktif benar-benar tidak bisa diakses publik.
- 0 regresi pada alur booking, payment, voucher, dan pengiriman chatbot setelah rilis.

---

*Dokumen ini final untuk tahap requirement — siap dipakai sebagai acuan estimasi effort & breakdown task development.*
