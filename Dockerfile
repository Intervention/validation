FROM php:8-cli

# install dependencies
RUN apt update \
        && apt install -y \
            git \
            libicu-dev \
            locales \
            locales-all \
            libzip-dev \
        && docker-php-ext-install \
            intl \
            opcache \
            fileinfo \
            bcmath \
            zip \
        && apt-get clean

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /project

# run tests
CMD composer install && ./vendor/bin/phpunit -vvv
