FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
 && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/{cache,sessions,views} \
 && mkdir -p bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000
CMD php artisan serve --host=0.0.0.0 --port=10000
