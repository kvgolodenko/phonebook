FROM php:5.5.38-fpm

COPY . /usr/src/app

WORKDIR /usr/src/app

CMD ["php-fpm"]

EXPOSE 80

