# Gunakan base image PHP yang sesuai untuk API
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath pcntl zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi Laravel ke dalam container
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Atur permission storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port untuk PHP-FPM
EXPOSE 9000

# Perintah default untuk menjalankan aplikasi
CMD ["php-fpm"]
