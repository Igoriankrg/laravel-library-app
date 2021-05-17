FROM php:8.0.3-fpm-alpine

# Set working directory
WORKDIR /var/www

RUN apk update \
    && apk add sqlite \
    && apk add socat

RUN set -xe && apk update && apk add --no-cache \
    libzip \
    bash \
    curl \
    libmcrypt \
    libmcrypt-dev \
    libxml2-dev \
    postgresql-dev \
    pcre-dev \
    git \
    autoconf \
    make \
    icu-dev \
    composer $PHPIZE_DEPS icu-dev icu-libs git \
    libzip-dev libmcrypt-dev libsodium libsodium-dev oniguruma oniguruma-dev \
    protoc linux-headers postgresql-dev openssh-client zlib-dev \
    && docker-php-source extract \
    && docker-php-ext-configure pdo_mysql \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && docker-php-ext-install pdo_pgsql pcntl sockets soap intl \
    && docker-php-ext-install pdo pdo_mysql \
    && apk add --update npm

RUN apk add --update php-pdo_sqlite

COPY xdebug.ini  /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN addgroup -S -g 1000 www
RUN adduser -S -u 1000 -G www www
RUN addgroup www www-data

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

ENV PHP_IDE_CONFIG 'serverName=Docker'

ADD php.ini /usr/local/etc/php
