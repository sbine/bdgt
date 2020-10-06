FROM php:7.4-fpm-alpine

# Install Packages
RUN apk update
RUN apk add bash openssl npm wget curl git zip unzip libpng-dev libzip-dev supervisor grep libmemcached-dev libmcrypt-dev \
  libxml2-dev libtool make autoconf g++

#libgsasl-dev build-base cyrus-sasl-dev pcre-dev imagemagick-dev

# Install Docker Packages
RUN docker-php-ext-install mysqli pdo pdo_mysql tokenizer xml zip

# Apache Config
#ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
#RUN a2enmod rewrite
#RUN a2enmod ssl

# Install Composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

#RUN service apache2 restart

WORKDIR /var/www/html

EXPOSE 80 443
