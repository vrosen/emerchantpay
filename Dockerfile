FROM php:7.4-apache

# working directory
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libldap2-dev \
    libbz2-dev \
    libreadline-dev \
    libsqlite3-dev \
    libxslt-dev \
    libssl-dev \
    libzip-dev \
    zip \
    unzip \
    ssl-cert

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN echo "ServerName empay.local" >> /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/src/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite headers

RUN a2enmod ssl

RUN a2ensite default-ssl.conf

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd

RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install bz2
RUN docker-php-ext-install calendar
RUN docker-php-ext-install ctype
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install ftp
RUN docker-php-ext-install gettext
RUN docker-php-ext-install iconv
RUN docker-php-ext-install json
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install phar
RUN docker-php-ext-install session
RUN docker-php-ext-install simplexml
RUN docker-php-ext-install sockets
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install xml
RUN docker-php-ext-install xsl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www

EXPOSE 80
