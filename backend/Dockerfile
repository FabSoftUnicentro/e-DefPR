# PHP
FROM phpearth/php:7.2-nginx
RUN apk add --no-cache php7.2-sodium php7.2-intl php7.2-pdo_mysql

# Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer global require "laravel/installer"

# Deploy
WORKDIR /var/backend
COPY . .

RUN composer install

EXPOSE 8000
# HEALTHCHECK --interval=1m CMD curl -f http://localhost/ || exit 1
