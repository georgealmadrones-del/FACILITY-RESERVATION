#!/usr/bin/env sh

# Clear and cache configs so APP_URL takes effect
php artisan config:clear
php artisan config:cache

# Run database migrations and seeders automatically on boot
php artisan migrate --force
php artisan db:seed --force

# Start the server pointing to the public directory
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}