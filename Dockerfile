FROM php:fpm-alpine

COPY ops/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    libzip-dev \
    libxslt-dev \
    libpng-dev \
    oniguruma-dev

# Add node-js and yarn
RUN set -eux \
    & apk add \
        --no-cache \
        nodejs \
        yarn

RUN docker-php-ext-install pdo pdo_pgsql zip xsl gd intl opcache exif mbstring

RUN apk add --update linux-headers

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug-3.2.2 \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps

# Configure Xdebug
RUN echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN apk add -U tzdata
ENV TZ=Europe/Warsaw
RUN cp /usr/share/zoneinfo/Europe/Warsaw /etc/localtime

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER 1000

WORKDIR /app
