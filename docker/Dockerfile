FROM php:7.3-cli

RUN apt-get update && \
    apt-get install -y git libicu-dev libzip-dev make nano net-tools wget zip zlib1g-dev

RUN docker-php-ext-install intl zip && docker-php-ext-enable intl zip

# install composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# add custom PHP.ini settings
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY ./includes/custom.ini /usr/local/etc/php/conf.d/custom.ini

RUN rm -rf /var/www/html/*
WORKDIR /var/www/html/

# adds user "todolo", adds him to group "www-data" and sets his home folder
# for more background information see:
# https://medium.com/@mccode/understanding-how-uid-and-gid-work-in-docker-containers-c37a01d01cf
RUN useradd -r --home /home/todolo -u 1000 todolo
RUN usermod -a -G www-data todolo
RUN mkdir /home/todolo
RUN chown todolo:www-data /home/todolo

CMD ["tail -f /dev/null"]
