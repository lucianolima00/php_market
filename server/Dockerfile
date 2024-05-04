FROM composer:2.7.4

ARG APP_PORT

COPY . /var/www/html

WORKDIR /var/www/html/server

COPY php-cli.ini /usr/local/etc/php/conf.d/

RUN apk update && apk add --no-cache \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql

CMD bash -c "composer install && php -S 0.0.0.0:${APP_PORT} public/index.php"
