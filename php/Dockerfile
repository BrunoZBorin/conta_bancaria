FROM wyveo/nginx-php-fpm:latest
FROM php:7.4-fpm
RUN apt update && apt-get install -y libzip-dev zip
RUN docker-php-ext-install mysqli pdo_mysql zip
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
EXPOSE 9000
CMD ["php-fpm"]