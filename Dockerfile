# ============================================================
# STAGE 1 — Build frontend assets (Tailwind, JS) pakai Node
# ============================================================
FROM node:20-alpine AS assets

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources/ resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build
# Hasil akhir stage ini: folder /app/public/build (CSS+JS yang udah di-compile)


# ============================================================
# STAGE 2 — PHP + dependency Composer
# ============================================================
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
# --no-scripts: skip artisan commands dulu (belum ada .env/app key di tahap ini)
# --no-dev: gak install package testing/dev, biar image lebih kecil
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist
COPY . .
RUN composer dump-autoload --optimize --no-dev


# ============================================================
# STAGE 3 — Image final: PHP-FPM + Nginx + Supervisor jadi 1 container
# ============================================================
FROM php:8.4-fpm-alpine

# Extension PHP yang dibutuhin Laravel + SQLite
RUN apk add --no-cache \
    nginx \
    supervisor \
    sqlite \
    sqlite-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath

WORKDIR /var/www/html

# Salin source code + hasil build dari stage sebelumnya
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Konfigurasi Nginx & Supervisor
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Folder yang butuh izin tulis (Laravel butuh ini buat cache, log, session, upload)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]
