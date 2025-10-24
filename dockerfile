# ============================================
# Stage 1: Build frontend assets (Vite + Vue)
# ============================================
FROM node:18-alpine AS node-builder
WORKDIR /app

# Copy only package files first for caching
COPY package*.json ./
RUN npm ci --silent

# Copy all files and build assets
COPY . .
RUN npm run build


# ============================================
# Stage 2: Install PHP dependencies (Composer)
# ============================================
FROM composer:latest AS vendor
WORKDIR /app

# Copy only composer files for caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts


# ============================================
# Stage 3: Final PHP 8.3 FPM production image
# ============================================
FROM php:8.3-fpm-alpine

# Install required system dependencies + PHP extensions
RUN apk add --no-cache \
    bash \
    icu-dev \
    libzip-dev \
    zip \
    oniguruma-dev \
    postgresql-dev

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl pdo pdo_pgsql mbstring zip opcache bcmath

# Set working directory
WORKDIR /var/www/html

# Copy vendor files from composer stage
COPY --from=vendor /app/vendor ./vendor

# Copy Vite-built assets from node stage
COPY --from=node-builder /app/public/build ./public/build

# Copy the full Laravel application
COPY . .

# ✅ Ensure correct storage & cache permissions (AFTER copying everything)
RUN chown -R www-data:www-data /var/www storage bootstrap/cache \
    && chmod -R 755 storage /var/www bootstrap/cache

# ✅ Run optional optimization commands only AFTER env is loaded (safe mode)
# You may uncomment these later for full production caching
# RUN php artisan config:cache || true \
#     && php artisan route:cache || true \
#     && php artisan view:cache || true

# Expose PHP-FPM port
EXPOSE 9000

CMD ["php-fpm"]
