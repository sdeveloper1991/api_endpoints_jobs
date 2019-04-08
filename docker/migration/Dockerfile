FROM php:7.2-fpm

RUN apt-get update && apt-get install -y openssl 

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug

WORKDIR /var/www/jobs

RUN mkdir /var/cache/prod
RUN mkdir /var/logs
RUN mkdir /var/sessions
RUN chown -R www-data:www-data /var/cache
RUN chown -R www-data:www-data /var/logs
RUN chown -R www-data:www-data /var/sessions

# Add the wait-for-it script and use it for the process entrypoint
COPY wait-for-it.sh /wait-for-it.sh
RUN chmod +x /wait-for-it.sh

ENTRYPOINT [ "sh","/wait-for-it.sh" ]
