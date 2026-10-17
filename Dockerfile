FROM php:8.4-cli

RUN apt-get update && apt-get install -y git unzip curl libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm ci \
    && npm run build

ENV APP_ENV=production
EXPOSE 10000

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}