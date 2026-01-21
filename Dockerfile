FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
 && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy source
COPY . .

# install deps
RUN composer install --no-dev --optimize-autoloader

# 🔥 FIX จริงอยู่ตรงนี้
RUN mkdir -p \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

# ✅ ใช้ artisan เท่านั้น
CMD php artisan serve --host=0.0.0.0 --port=10000
