#!/bin/bash

# Substitute PORT in nginx config
export PORT=${PORT:-8080}
envsubst '$PORT' < /etc/nginx/nginx.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/nginx.conf
echo "PORT is: $PORT"
grep listen /etc/nginx/nginx.conf

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear and cache config
echo "Caching configuration..."
php artisan config:clear
php artisan config:cache

# Clear and cache routes
echo "Caching routes..."
php artisan route:clear
php artisan route:cache

# Clear and cache views
echo "Caching views..."
php artisan view:clear
php artisan view:cache

# Set permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

# Test php-fpm configuration
echo "Testing php-fpm configuration..."
php-fpm -t

# Tail laravel log in background so it shows in Railway logs
touch /var/www/html/storage/logs/laravel.log
tail -f /var/www/html/storage/logs/laravel.log &

echo "Application is ready!"
