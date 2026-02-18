FROM php:8.2-apache

# Enable mysqli & pgsql if needed
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

# Expose port
EXPOSE 80
