FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    zip \
    unzip \
    libpq-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_pgsql mbstring pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

RUN useradd -G www-data,root -u 1000 -d /home/dev dev && \
    mkdir -p /home/dev/.composer && \
    chown -R dev:dev /home/dev

WORKDIR /var/www

COPY composer.* ./

RUN composer install --no-dev --no-scripts --no-autoloader

COPY --chown=dev:www-data . .

RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R dev:www-data .

USER root

RUN composer dump-autoload --optimize && \
    npm install 

COPY .docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

USER dev

ENTRYPOINT ["/entrypoint.sh"]