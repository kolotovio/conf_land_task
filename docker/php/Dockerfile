FROM php:8-fpm

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