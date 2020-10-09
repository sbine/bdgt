FROM php:7.4-fpm-alpine

# userid of www-data (linux support file permissions)
ARG DOCKER_WWW_USER_ID=1000
ARG DOCKER_WWW_GROUP_ID=1000
ENV DOCKER_WWW_USER_ID $DOCKER_WWW_USER_ID
ENV DOCKER_WWW_GROUP_ID $DOCKER_WWW_GROUP_ID
RUN apk add shadow \
    && usermod --non-unique --uid ${DOCKER_WWW_USER_ID} www-data \
    && groupmod --gid ${DOCKER_WWW_GROUP_ID} www-data

# Install Packages
RUN apk update
RUN apk add bash openssl npm wget curl git zip unzip libpng-dev libzip-dev supervisor grep libmemcached-dev libmcrypt-dev \
  libxml2-dev libtool make autoconf g++

#libgsasl-dev build-base cyrus-sasl-dev pcre-dev imagemagick-dev

# Install Docker Packages
RUN docker-php-ext-install gd mysqli pdo pdo_mysql tokenizer xml zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

#RUN service apache2 restart

WORKDIR /var/www/html

EXPOSE 80 443

USER www-data
