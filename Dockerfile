FROM php:8.4-fpm

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 storage bootstrap/cache

EXPOSE 8080
CMD php artisan migrate --force && php artisan config:cache && php -S 0.0.0.0:${PORT:-8080} -t public
