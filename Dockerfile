FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN groupadd -g 1000 docker \
    && useradd -m -u 1000 -g docker docker -G sudo \
    && echo 'docker:docker' | chpasswd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

ADD ./ /var/www

RUN composer install --optimize-autoloader
RUN php artisan l5-swagger:generate
RUN composer clear-cache
RUN php artisan key:generate

USER docker
