#!/usr/bin/env bash

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Start the Laravel development server bound to Render's port
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}