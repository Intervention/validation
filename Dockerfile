FROM php:8.1-cli-alpine

# install dependencies
RUN apk add --no-cache \
    icu-dev \
    git \
    zip \
  && docker-php-ext-install \
    intl

COPY --from=composer /usr/bin/composer /usr/bin/composer

# setup entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
