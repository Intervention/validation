FROM php:8.1-cli

RUN apt update \
        && apt install -y \
            libicu-dev \
        && docker-php-ext-install \
            intl \
        && apt-get clean

# install composer
#
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
