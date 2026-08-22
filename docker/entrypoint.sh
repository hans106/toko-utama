#!/bin/sh
set -e

echo "==> Menyesuaikan port Nginx ke \$PORT dari Railway (${PORT:-8080})"
sed -i "s/listen 8080;/listen ${PORT:-8080};/" /etc/nginx/nginx.conf

echo "==> Memastikan file database SQLite ada"
mkdir -p "$(dirname "${DB_DATABASE:-/var/www/html/database/database.sqlite}")"
touch "${DB_DATABASE:-/var/www/html/database/database.sqlite}"

echo "==> Menyiapkan symlink storage (buat akses foto produk yang diupload)"
php artisan storage:link || true

echo "==> Menjalankan migration (aman dijalankan berkali-kali, cuma apply yang baru)"
php artisan migrate --force

echo "==> Cache config, route, dan view biar aplikasi lebih cepat"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Menjalankan Nginx + PHP-FPM"
exec supervisord -c /etc/supervisord.conf
