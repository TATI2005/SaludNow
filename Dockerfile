FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip unzip git curl libssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data storage bootstrap/cache public/img
RUN chmod -R 775 storage bootstrap/cache public/img

ARG CLOUDINARY_URL
ENV CLOUDINARY_URL=$CLOUDINARY_URL

EXPOSE 80