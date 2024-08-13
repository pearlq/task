FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www
COPY . .

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

CMD ["php-fpm"]