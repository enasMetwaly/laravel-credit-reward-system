FROM php:8.3-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    curl \
    nodejs \
    npm \
&& docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip \
    soap \
&& a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only necessary files (avoid overwriting volumes)
COPY . /var/www/html

# Change document root to public directory and enable .htaccess
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/000-default.conf

# Set ServerName to suppress Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Pass UID and GID as build arguments with defaults
ARG UID=33
ARG GID=33

# Ensure storage and cache directories exist with proper permissions
RUN mkdir -p /var/www/html/storage \
    && mkdir -p /var/www/html/storage/framework \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache

# Set ownership based on UID/GID
RUN if [ "$UID" != "33" ] || [ "$GID" != "33" ]; then \
      groupadd -g ${GID} appgroup && useradd -u ${UID} -g ${GID} -m appuser && \
      chown -R ${UID}:${GID} /var/www/html/storage /var/www/html/bootstrap/cache; \
    else \
      chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache; \
    fi

# Set permissions
RUN chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public

# Switch to dynamic user or www-data
USER ${UID}:${GID}