php artisan migrate --force

php artisan config:cache
php artisan route:cache

php-fpm &

nginx -g "daemon off;"
