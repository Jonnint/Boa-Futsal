# Panduan Deploy ke ByteHost

## Langkah 1: Persiapan File
1. Zip semua file project ini (kecuali folder `node_modules` dan `vendor`)
2. Upload ke ByteHost via File Manager atau FTP

## Langkah 2: Setup di ByteHost

### A. Upload File
1. Login ke cPanel ByteHost
2. Buka **File Manager**
3. Upload zip file ke folder `public_html`
4. Extract zip file
5. Pindahkan semua file dari folder `boafutsalv1` ke root `public_html`

### B. Install Dependencies
1. Buka **Terminal** di cPanel (jika tersedia)
2. Jalankan:
   ```bash
   cd public_html
   composer install --no-dev --optimize-autoloader
   ```

### C. Setup Database
1. Buka **MySQL Databases** di cPanel
2. Buat database baru (misal: `username_boafutsal`)
3. Buat user database dan set password
4. Assign user ke database dengan ALL PRIVILEGES

### D. Konfigurasi .env
1. Copy `.env.example` menjadi `.env`
2. Edit `.env`:
   ```
   APP_NAME="BOA Futsal"
   APP_ENV=production
   APP_KEY=base64:W+Mnzs6CK3BtS9tYFcKnICzAwD3jFuMNAJi/q+LbdSE=
   APP_DEBUG=false
   APP_URL=https://yourdomain.byethost.com
   
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=username_boafutsal
   DB_USERNAME=username_dbuser
   DB_PASSWORD=your_password
   
   SESSION_DRIVER=file
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   ```

### E. Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### F. Run Migration
```bash
php artisan migrate --force
php artisan db:seed --force
```

### G. Optimize
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Langkah 3: Akses Website
Buka: `https://yourdomain.byethost.com`

## Troubleshooting

### Error 500
- Cek file `.env` sudah benar
- Cek permissions folder `storage` dan `bootstrap/cache`
- Cek error log di cPanel

### Database Connection Error
- Pastikan DB credentials benar
- Pastikan user sudah di-assign ke database
- Coba gunakan `127.0.0.1` instead of `localhost`

### Composer tidak tersedia
- Download vendor folder dari local
- Upload ke hosting via FTP

## Kredensial Admin Default
Setelah seeding, login dengan:
- Email: (cek di `database/seeders/AdminSeeder.php`)
- Password: (cek di `database/seeders/AdminSeeder.php`)
