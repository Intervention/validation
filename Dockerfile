# ##############################################
# stage: composer
# ##############################################
FROM composer:2 as composer

# install composer dependencies
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# ##############################################
# stage: testing
# ##############################################
FROM php:8.1-cli

# install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libicu-dev

# install php extensions
RUN docker-php-ext-install -j "$(nproc)" \
    intl

# copy application
COPY . /app
COPY --from=composer /app/vendor/ /app/vendor/

# run tests
WORKDIR /app
CMD ./vendor/bin/phpunit -vvv
