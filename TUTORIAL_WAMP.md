# Tutorial Lengkap Menjalankan Ruto Store System di WAMP Server

## Prasyarat

- WAMP Server terinstall (download dari [wampserver.com](https://www.wampserver.com/))
- PHP versi minimal **8.3** (penting!)
- Node.js dan NPM terinstall

---

## Langkah 1: Cek dan Update PHP di WAMP

### 1.1 Cek Versi PHP WAMP
1. Klik icon **WAMP** di system tray (pojok kanan bawah)
2. Pilih **PHP** → **Version**
3. Cek versi yang aktif

### 1.2 Jika PHP Belum 8.3+
1. Download PHP 8.3+ addon dari [wampserver.aviatechno.net](http://wampserver.aviatechno.net/?lang=en&prerequis=afficher)
2. Install addon PHP tersebut
3. Restart WAMP
4. Ubah PHP version ke 8.3+ dari menu WAMP

---

## Langkah 2: Pindahkan Project ke Folder WAMP

### Opsi A: Copy Project (Cara Mudah)
1. Buka folder: `C:\wamp64\www\` (atau `C:\wamp\www\`)
2. Copy folder project ke sana, rename jadi `ruto-store`
3. Path lengkapnya: `C:\wamp64\www\ruto-store\`

### Opsi B: Buat Symbolic Link (Cara Praktis)
Buka **Command Prompt sebagai Administrator**, jalankan:

```cmd
mklink /D "C:\wamp64\www\ruto-store" "c:\Users\fahmi\Documents\semester 6\IMK\tahap 2\Ruto_Store_System-main\Ruto_Store_System-main"
```

---

## Langkah 3: Setup Virtual Host di WAMP

### 3.1 Edit File httpd-vhost.conf
1. Klik icon **WAMP** → **Apache** → **httpd-vhost.conf**
2. File akan terbuka di Notepad
3. Scroll ke paling bawah
4. Tambahkan kode berikut:

```apache
<VirtualHost *:80>
    ServerName ruto-store.test
    DocumentRoot "C:/wamp64/www/ruto-store/public"
    
    <Directory "C:/wamp64/www/ruto-store/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

5. **Save** file tersebut

### 3.2 Edit File hosts (Windows)
1. Buka **Notepad sebagai Administrator**
2. File → Open → browse ke `C:\Windows\System32\drivers\etc\hosts`
3. Ubah filter dari "Text Documents" ke "All Files" agar file `hosts` terlihat
4. Tambahkan baris ini di akhir file:

```
127.0.0.1    ruto-store.test
```

5. **Save** file

---

## Langkah 4: Restart WAMP

1. Klik icon **WAMP** → **Restart All Services**
2. Tunggu sampai icon WAMP berubah jadi **hijau**
3. Jika ada error, cek:
   - Apakah port 80 dipakai program lain (Skype, IIS, dll)
   - Apakah syntax di `httpd-vhost.conf` benar

---

## Langkah 5: Install Dependencies PHP (Composer)

### 5.1 Cek Composer
Buka **Command Prompt**, jalankan:

```cmd
composer --version
```

Jika belum ada, download dari [getcomposer.org](https://getcomposer.org/download/)

### 5.2 Install Dependencies
**Cara 1 - Jika Composer Global:**
```cmd
cd C:\wamp64\www\ruto-store
composer install
```

**Cara 2 - Pakai composer.phar lokal (sudah ada di project):**
```cmd
cd C:\wamp64\www\ruto-store
C:\wamp64\bin\php\php8.3.x\php.exe composer.phar install
```

*(Ganti `php8.3.x` sesuai versi PHP WAMP Anda)*

---

## Langkah 6: Setup Database

### Opsi A: Pakai SQLite (Default - Paling Mudah)
Database sudah siap, file ada di `database/database.sqlite`. Tidak perlu setting apapun!

### Opsi B: Pakai MySQL WAMP

#### 6.1 Buat Database
1. Buka browser, akses: http://localhost/phpmyadmin
2. Klik **New** di sidebar kiri
3. Isi **Database name**: `ruto_store`
4. Klik **Create**

#### 6.2 Edit File .env
Buka file `.env` di folder project, ubah bagian database:

**Dari:**
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

**Jadi:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ruto_store
DB_USERNAME=root
DB_PASSWORD=
```

*(Password default WAMP biasanya kosong)*

---

## Langkah 7: Jalankan Migrasi Database

Buka **Command Prompt**, jalankan:

```cmd
cd C:\wamp64\www\ruto-store
C:\wamp64\bin\php\php8.3.x\php.exe artisan migrate
```

Atau jika PHP sudah global:

```cmd
cd C:\wamp64\www\ruto-store
php artisan migrate
```

Perintah ini akan membuat semua tabel di database.

---

## Langkah 8: (Opsional) Seed Database dengan Data Dummy

Jika ingin isi database dengan data contoh:

```cmd
php artisan db:seed
```

---

## Langkah 9: Install Dependencies Frontend (NPM)

```cmd
cd C:\wamp64\www\ruto-store
npm install
npm run build
```

Tunggu sampai selesai. Ini akan compile CSS/JS dengan Vite.

---

## Langkah 10: Buka Aplikasi di Browser

### Buka browser dan akses:
```
http://ruto-store.test
```

Atau jika virtual host tidak jalan:
```
http://localhost/ruto-store/public
```

---

## Troubleshooting

### ❌ Error: "Target class [Controller] does not exist"
**Solusi:** Jalankan:
```cmd
php artisan clear-compiled
php artisan optimize:clear
composer dump-autoload
```

### ❌ Error: "syntax error, unexpected token"
**Penyebab:** PHP version masih di bawah 8.3

**Solusi:** Update PHP WAMP ke 8.3+

### ❌ WAMP Icon Kuning/Merah
**Penyebab:** Port 80 atau 3306 dipakai program lain

**Solusi:**
1. Tutup Skype, IIS, atau aplikasi lain yang pakai port 80
2. Atau ubah port Apache di WAMP (klik icon → Apache → httpd.conf)

### ❌ Page 404 Not Found
**Solusi:**
1. Pastikan akses ke: `http://ruto-store.test` (bukan `http://ruto-store.test/public`)
2. Cek file `.htaccess` ada di folder `public/`
3. Pastikan `mod_rewrite` Apache aktif di WAMP

### ❌ Error "SQLSTATE[HY000]"
**Solusi:**
1. Cek konfigurasi database di file `.env`
2. Pastikan database sudah dibuat di phpMyAdmin
3. Jalankan `php artisan migrate` lagi

---

## Fitur-Fitur Sistem

Setelah berhasil jalan, Anda bisa:

- **Admin Dashboard**: Kelola produk, kategori, kasir, laporan
- **Kasir**: Proses transaksi penjualan
- **User**: Pesan produk via QR code
- **Laporan**: Grafik penjualan, stok, transaksi

---

## Development Mode (Auto-Reload)

Jika mau edit code dan auto-reload:

**Terminal 1:**
```cmd
php artisan serve
```

**Terminal 2:**
```cmd
npm run dev
```

Akses: http://localhost:8000

---

## Catatan Penting

- ✅ Project ini pakai **Laravel 13** dengan **PHP 8.3+**
- ✅ Database default: **SQLite** (mudah dan portable)
- ✅ Frontend: **Tailwind CSS** + **Alpine.js** + **Vite**
- ✅ Authentication: **Laravel Breeze**

---

## Selesai! 🎉

Jika ada masalah, cek bagian **Troubleshooting** di atas atau tanya di chat.
