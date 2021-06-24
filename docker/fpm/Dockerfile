FROM php:7.2-fpm

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

# install phpunit
RUN curl https://phar.phpunit.de/phpunit-5.phar -L > phpunit.phar \
  && chmod +x phpunit.phar \
  && mv phpunit.phar /usr/local/bin/phpunit \
  && phpunit --version

RUN apt-get update && apt-get install -y zlib1g-dev \
    && docker-php-ext-install zip

RUN apt-get update && apt-get install -y git

RUN apt-get update && apt-get install libxrender1
RUN apt-get update && apt-get install -y libfontconfig1

RUN apt-get install -y libxml2-dev unzip && docker-php-ext-install soap && docker-php-ext-enable soap

# GD
RUN apt-get update
RUN apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir

RUN docker-php-ext-install gd

RUN docker-php-ext-install calendar

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
