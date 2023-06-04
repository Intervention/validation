FROM php:8-cli

# install dependencies
#
RUN apt update \
        && apt install -y \
            libicu-dev \
            locales \
            locales-all \
        && docker-php-ext-install \
            intl \
            opcache \
            fileinfo \
            bcmath \
        && apt-get clean

# install composer
#
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
