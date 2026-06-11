php artisan migrate --force

php artisan config:cache
php artisan route:cache

php-fpm &

php artisan queue:work redis --queue=notifications --sleep=3 --tries=3 --daemon &

nginx -g "daemon off;"
