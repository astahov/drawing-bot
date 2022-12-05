FROM php:7.4-fpm

RUN apt-get update \
    && apt-get install -y \
        libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && apt-get install -y zlib1g-dev libzip-dev \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
