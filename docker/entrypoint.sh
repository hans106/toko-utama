#!/bin/sh
set -e

echo "==> Menyesuaikan port Nginx ke \$PORT dari Railway (${PORT:-8080})"
sed -i "s/listen 8080;/listen ${PORT:-8080};/" /etc/nginx/nginx.conf

echo "==> Regenerasi daftar package Laravel"
php artisan package:discover --ansi

echo "==> Memastikan file database SQLite ada"
mkdir -p "$(dirname "${DB_DATABASE:-/var/www/html/database/database.sqlite}")"
touch "${DB_DATABASE:-/var/www/html/database/database.sqlite}"

echo "==> Menyiapkan symlink storage"
php artisan storage:link || true

echo "==> Menjalankan migration"
php artisan migrate --force

echo "==> Cache config, route, dan view"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Memberi izin tulis ke www-data (setelah semua file SQLite/journal terbentuk)"
chown -R www-data:www-data "$(dirname "${DB_DATABASE:-/var/www/html/database/database.sqlite}")"
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "==> Menjalankan Nginx + PHP-FPM"
exec supervisord -c /etc/supervisord.conf