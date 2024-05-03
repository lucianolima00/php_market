FROM php:8.1-cli

ARG APP_PORT

RUN apt-get update -y
RUN apt-get upgrade -y

COPY . /var/www/html

WORKDIR /var/www/html

CMD bash -c "php -S market_app:${APP_PORT} public/index.php"
