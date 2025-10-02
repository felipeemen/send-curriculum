# Etapa 1: Node/Bun build
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build

# Etapa 2: PHP (Laravel)
FROM php:8.2-fpm AS backend

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY --from=frontend /app/public/build ./public/build
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]
