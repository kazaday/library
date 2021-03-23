composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
php -S 127.0.0.1:8000 -t public/
