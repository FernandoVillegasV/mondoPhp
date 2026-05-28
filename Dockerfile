FROM php:8.2-apache

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    pkg-config \
    libssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensión MongoDB
RUN pecl install mongodb

RUN docker-php-ext-enable mongodb

# Verificar que MongoDB quedó instalado
RUN php -m | grep mongodb

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY . .

# Instalar dependencias ignorando platform reqs temporalmente
RUN composer install --ignore-platform-req=ext-mongodb

EXPOSE 80
