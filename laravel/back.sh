#!/bin/bash



composer self-update
composer install

cd tools/php-cs-fixer &&
composer install


rm -f public/storage
php artisan storage:link
php artisan migrate
php-fpm



