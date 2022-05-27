FROM php:8.1-fpm-buster
RUN echo "memory_limit = -1" >> $PHP_INI_DIR/php.ini
RUN echo "xdebug.client_host=host.docker.internal" >> $PHP_INI_DIR/php.ini
RUN echo "date.timezone = Europe/Moscow" >> $PHP_INI_DIR/php.ini
RUN echo "xdebug.mode=debug" >> $PHP_INI_DIR/php.ini

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd intl xdebug zip pdo_pgsql @composer








