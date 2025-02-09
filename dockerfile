FROM php:8.1.0-apache
WORKDIR /var/www/html

# Enable Apache modules
RUN a2enmod rewrite

# Update and install necessary libraries
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    nodejs \ 
    # Provides the runtime for JavaScript, enabling the execution of development tools for Vite.
    npm 
    # Provides JavaScript dependencies

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP extensions
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Set Apache document root to the Laravel public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ensure web server user owns the files
RUN chown -R www-data:www-data /var/www/html

# Expose the necessary port
EXPOSE 80
