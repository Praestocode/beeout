# Dockerfile per il servizio laravel
FROM php:8.3-apache

# installa pacchetti di sistema utili e le estensioni PHP necessarie
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo_mysql mysqli zip \
    && rm -rf /var/lib/apt/lists/*

# abilita rewrite (utile per Laravel se usi l'apache)
RUN a2enmod rewrite

# copia composer dal container ufficiale composer (veloce e affidabile)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
