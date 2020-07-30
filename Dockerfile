FROM php:fpm-alpine

RUN apk add oniguruma-dev
RUN apk add nginx
RUN apk add bash

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN rm -rf /var/www/*
RUN mkdir /run/nginx

RUN mkdir /spacemy
RUN mkdir /var/www/application
RUN mkdir /var/www/data

ADD website/public /var/www/html
ADD website/application /var/www/application

RUN chmod +x /var/www/data

COPY packaging/version /var/www/packaging/version
COPY .git/refs/heads/master /var/www/packaging/hash

COPY website/php.ini /usr/local/etc/php

COPY website/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY website/nginx/website.conf /etc/nginx/snippets/website.conf

EXPOSE 8080

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
CMD /usr/local/bin/docker-entrypoint.sh