FROM php:fpm-bullseye

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN set -eux; \
	apt-get update; \
	apt-get install -y \
		git \
		libicu-dev \
		libicu-dev \
		unzip \
	; \
	rm -rf /var/lib/apt/lists/*

WORKDIR /

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./symfony.sh /symfony.sh

RUN /symfony.sh

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

EXPOSE 9003