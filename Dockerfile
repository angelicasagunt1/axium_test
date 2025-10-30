# PHP 8.2 con FPM
FROM php:8.2-fpm

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev libssl-dev \
    iputils-ping dnsutils net-tools wget \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath

# Node.js 18 y Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && npm install --global yarn \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer desde imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copia del proyecto
COPY . .

# Instalación de dependencias Symfony
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Instalación de dependencias frontend
RUN yarn install

# Permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Puerto PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]
