FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libicu-dev libxml2-dev libzip-dev zlib1g-dev \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
