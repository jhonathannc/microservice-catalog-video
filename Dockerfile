FROM php:8.1-fpm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apt-get update && \
  apt-get install -y git && \
  install-php-extensions zip


WORKDIR /var/www