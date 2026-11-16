#!/usr/bin/env bash

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Start your web server (e.g., Apache, Nginx, or php artisan serve)