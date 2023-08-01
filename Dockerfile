FROM php:8.0

# Instal dependensi GD
RUN apt-get update \
    && apt-get install -y libpng-dev libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd
