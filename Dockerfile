FROM php:8.1-cli

RUN apt update \
        && apt install -y \
            libicu-dev \
            git \
            zip \
        && docker-php-ext-install \
            intl \
        && apt-get clean

COPY --from=composer /usr/bin/composer /usr/bin/composer
