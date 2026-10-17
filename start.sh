#!/usr/bin/env sh

# Run database migrations and seeders automatically
php artisan migrate --force
php artisan db:seed --force

# Start the web server / process defined by the container
php artisan serve --host=0.0.0.0 --port=$PORT