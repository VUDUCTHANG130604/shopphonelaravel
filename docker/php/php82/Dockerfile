FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libmagickwand-dev \
    imagemagick \
    libzip-dev 
RUN pecl install imagick && \
    docker-php-ext-enable imagick
# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add custom php.ini
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Create log directory
RUN mkdir -p /var/log/php
RUN chmod -R 777 /var/log/php

WORKDIR /var/www/html