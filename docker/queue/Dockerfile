FROM composer as composer

WORKDIR /var/www

COPY composer.json composer.lock /var/www/
COPY . /var/www

RUN composer install
RUN composer dump-autoload -o

FROM php:8.2-fpm as php

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer /var/www /var/www

# Change current user to www
USER 1000

# Expose port 9000 and start php server
EXPOSE 9000
CMD ["php-fpm"]
