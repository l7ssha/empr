FROM php:fpm-alpine

ARG TIMEZONE

COPY ops/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    libzip-dev \
    libxslt-dev \
    libpng-dev \
    oniguruma-dev

RUN docker-php-ext-install pdo pdo_pgsql zip xsl gd intl opcache exif mbstring

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER 1000

WORKDIR /app
