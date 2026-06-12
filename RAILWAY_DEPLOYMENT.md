# Railway Deployment Guide

## Overview
Project ini sudah dikonfigurasi untuk deployment ke Railway menggunakan Dockerfile custom dengan PHP-FPM dan Nginx.

## Files yang Ditambahkan
- `Dockerfile` - Konfigurasi Docker image
- `docker/nginx.conf` - Konfigurasi Nginx dengan support untuk $PORT dari Railway
- `docker/supervisord.conf` - Konfigurasi Supervisor untuk menjalankan PHP-FPM dan Nginx
- `docker/start.sh` - Script startup untuk migration dan caching config
- `.dockerignore` - File yang diabaikan saat build Docker image
- `railway.json` - Konfigurasi deployment Railway

## Environment Variables yang Diperlukan di Railway

Setelah deploy ke Railway, tambahkan environment variables berikut di tab Settings > Variables:

### Required
- `APP_ENV` = `production`
- `APP_KEY` = Generate dengan `php artisan key:generate` atau paste dari .env lokal
- `APP_DEBUG` = `false`
- `APP_URL` = URL Railway deployment Anda

### Database (PostgreSQL)
- `DB_CONNECTION` = `pgsql`
- `DB_HOST` = Host dari Railway PostgreSQL service
- `DB_PORT` = `5432`
- `DB_DATABASE` = Database name dari Railway PostgreSQL service
- `DB_USERNAME` = Username dari Railway PostgreSQL service
- `DB_PASSWORD` = Password dari Railway PostgreSQL service

### Lainnya (opsional)
- `CACHE_DRIVER` = `file`
- `SESSION_DRIVER` = `file`
- `QUEUE_CONNECTION` = `sync`

## Cara Deploy ke Railway

1. **Push code ke GitHub**
   ```bash
   git add .
   git commit -m "Add Docker configuration for Railway deployment"
   git push
   ```

2. **Deploy ke Railway**
   - Buka [railway.app](https://railway.app)
   - Klik "New Project"
   - Pilih "Deploy from GitHub repo"
   - Pilih repository Ruto_Store_System Anda
   - Railway akan otomatis mendeteksi `railway.json` dan `Dockerfile`

3. **Tambahkan Database**
   - Di project Railway, klik "New Service"
   - Pilih "PostgreSQL"
   - Tunggu database ready

4. **Set Environment Variables**
   - Buka tab Settings > Variables
   - Tambahkan semua environment variables di atas
   - Khusus untuk database, Railway akan otomatis inject variables untuk PostgreSQL service:
     - `PGHOST`, `PGPORT`, `PGDATABASE`, `PGUSER`, `PGPASSWORD`
   - Anda bisa menggunakan variables ini untuk konfigurasi database Laravel

5. **Redeploy**
   - Setelah environment variables di-set, klik "Redeploy" di tab Deployments

## Troubleshooting

### Container tidak respond ke healthcheck
- Cek tab "Deploy Logs" untuk melihat error runtime
- Pastikan semua environment variables sudah di-set dengan benar
- Pastikan database sudah ready sebelum aplikasi start

### Error database connection
- Pastikan database service sudah running di Railway
- Cek koneksi database di environment variables
- Script `start.sh` akan menunggu database ready sebelum menjalankan migration

### Error permission
- Dockerfile sudah meng-set permission untuk storage dan bootstrap/cache
- Script `start.sh` akan meng-set permission ulang saat startup

## Catatan Penting
- Script `start.sh` akan otomatis menjalankan migration saat container start
- Script akan meng-cache config, routes, dan views untuk performance
- Nginx akan menggunakan port dari environment variable `$PORT` yang di-inject oleh Railway
- Healthcheck timeout di-set ke 300 detik untuk memberi waktu cukup untuk migration
