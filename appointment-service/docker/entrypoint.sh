php artisan migrate --force

php artisan config:cache
php artisan route:cache

php-fpm &

php artisan queue:work redis --queue=notifications --daemon &

nginx -g "daemon off;"
