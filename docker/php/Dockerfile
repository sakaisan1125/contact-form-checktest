FROM php:8.2-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y \
  default-mysql-client \
  zlib1g-dev \
  libzip-dev \
  libjpeg-dev \
  libpng-dev \
  libfreetype6-dev \
  unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql zip gd

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www
