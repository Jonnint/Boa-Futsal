# BOA Futsal - Authentication Setup

## Setup Selesai! ✅

### Fitur yang Sudah Disetup

✅ Laravel Breeze (Authentication)
✅ Login & Register dengan custom design
✅ Dashboard user dengan stats & quick actions
✅ Profile management
✅ Password reset
✅ Email verification (optional)
✅ Responsive & modern UI sesuai konsep homepage

### Halaman yang Tersedia

1. **Homepage** (`/`)
   - Navbar dengan tombol Login & Register
   - Jika sudah login, tampil Dashboard & Logout

2. **Login** (`/login`)
   - Custom design dark mode + green accent
   - Remember me checkbox
   - Forgot password link
   - Link ke register

3. **Register** (`/register`)
   - Custom design dark mode + green accent
   - Form: Name, Email, Password, Confirm Password
   - Link ke login

4. **Dashboard** (`/dashboard`)
   - Welcome banner dengan nama user
   - Stats cards (Total Booking, Booking Aktif, Pengeluaran)
   - Quick actions (Booking Baru, Riwayat, Profil)
   - Protected route (harus login)

5. **Profile** (`/profile`)
   - Edit profile information
   - Update password
   - Delete account

6. **Sejarah** (`/sejarah`)
   - Halaman sejarah BOA Futsal

### Design System

**Colors:**
- Background: #050505, #080808
- Primary: Green (#22c55e, #4ade80)
- Text: White, Gray-400
- Borders: white/10, white/20

**Components:**
- Rounded corners: 1.5rem - 2rem
- Blur effects & gradients
- Hover animations
- Glow effects on green elements

### Routes

```
GET  /                  - Homepage
GET  /login             - Login page
POST /login             - Login action
GET  /register          - Register page
POST /register          - Register action
POST /logout            - Logout action
GET  /dashboard         - User dashboard (protected)
GET  /profile           - Edit profile (protected)
GET  /sejarah           - Sejarah page
GET  /forgot-password   - Forgot password
POST /reset-password    - Reset password
```

### Middleware

- `auth` - Harus login
- `verified` - Email harus verified (optional, bisa dinonaktifkan)
- `guest` - Hanya untuk yang belum login

### Next Steps

1. Bikin model & migration untuk:
   - Lapangan (fields)
   - Booking
   - Payment

2. Implement booking system

3. Setup payment gateway (optional)

4. Email notifications untuk booking

### Testing

1. Register user baru via `/register`
2. Login via `/login`
3. Akses dashboard via `/dashboard`
4. Edit profile via `/profile`
5. Logout

### Notes

- Semua view sudah custom (tidak pakai Breeze default)
- Design konsisten dengan homepage
- Dark mode by default
- Responsive untuk mobile & desktop
