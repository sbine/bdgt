FROM php:7.3-alpine

RUN apk update && apk add --no-cache \
      bash make mariadb-client \
      nodejs libxml2-dev libtool \
      npm openssl g++ \
      git gcc imagemagick-dev \
      libssl-dev

RUN wget https://getcomposer.org/composer-stable.phar -O /usr/local/bin/composer && chmod +x /usr/local/bin/composer

RUN docker-php-ext-install \
      bcmath \
      pdo \
      pdo_mysql \
      xml \
      tokenizer \
      exif \
      json \
      mbstring \
      fileinfo \
      ctype

WORKDIR /var/www/html
