FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev \
 && docker-php-ext-install pdo pdo_pgsql fileinfo

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader \
 && php artisan optimize:clear

RUN mkdir -p \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/sessions \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public
