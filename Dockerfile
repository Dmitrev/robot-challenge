FROM php:8.0.2-fpm

RUN apt-get update && apt-get -y install wget git zip unzip

# installer composer
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet && mv composer.phar /bin/composer
