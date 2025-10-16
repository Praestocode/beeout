FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mysqli zip \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
