#!/usr/bin/env bash

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Use 'exec' so the server becomes the main container process and stays alive
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}