FROM php:8.3.9-fpm

# Домашний каталог контейнера
WORKDIR /var/www

#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Обновление системы
RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y

# Устанавливаем необходимые пакеты
RUN apt-get update && apt-get install -y \
    build-essential \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libzip-dev libpq-dev libgmp-dev libffi-dev libssl-dev \
    libfreetype6 libfreetype6-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    vim nano \
    zip unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN docker-php-ext-install gd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Установка composer (копируем из официального образа)
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Чистим файлы
RUN docker-php-source delete
RUN apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y