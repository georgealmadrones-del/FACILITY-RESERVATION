FROM php:8.4-cli

# Install system dependencies and PHP database drivers for both MySQL and PostgreSQL
RUN apt-get update && apt-get install -y git unzip curl libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP and Node dependencies, then build frontend assets
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm ci \
    && npm run build

ENV APP_ENV=production
EXPOSE 10000

# Make start.sh executable and use it as the default container command
RUN chmod +x /app/start.sh
CMD ["/app/start.sh"]