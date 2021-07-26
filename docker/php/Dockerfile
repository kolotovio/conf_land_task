FROM php:8-fpm

# Installing required packages
RUN apt-get update && apt-get install -y \
    libzip-dev \
    wget --no-install-recommends

# Installing composer
RUN wget https://getcomposer.org/installer \
    && php installer \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

RUN mkdir /var/www/.composer && chmod -R 755 /var/www/.composer && chown -R www-data:www-data /var/www/.composer

# Turn on extensions
RUN docker-php-ext-install opcache bcmath zip

# Cleaning up
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* var/tmp/*

# Set default settings
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./opcache.ini "$PHP_INI_DIR/conf.d/opcache.ini"
COPY ./memory_limit.ini "$PHP_INI_DIR/conf.d/docker-php-memlimit.ini"
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Configure and set a non-root user
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && usermod -o -u ${PUID} -g www-data www-data

USER www-data:www-data

# Set a project work directory
WORKDIR /var/www/src

EXPOSE 9000

CMD ["php-fpm"]