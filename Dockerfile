FROM php:8.2-apache

# Install required system packages and PHP extensions
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
        libonig-dev \
    && docker-php-ext-install \
        intl \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Use Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the project directory
WORKDIR /var/www/html

# Install PHP dependencies first
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader

# Copy the CodeIgniter project
COPY . .

# Use CodeIgniter's public folder as Apache's document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV PORT=10000

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Allow CodeIgniter .htaccess files
RUN sed -i \
    '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

# Configure Apache for Render's port
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:10000>/g' /etc/apache2/sites-available/*.conf

# Create writable CodeIgniter folders
RUN mkdir -p \
        /var/www/html/writable/session \
        /tmp/ci_sessions \
    && chown -R www-data:www-data \
        /var/www/html/writable \
        /tmp/ci_sessions \
    && chmod -R 775 \
        /var/www/html/writable \
        /tmp/ci_sessions

EXPOSE 10000