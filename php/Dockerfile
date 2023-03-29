##############################################
FROM php:7.4-fpm

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# make sure apt is up to date
RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential \
    libssl-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libgmp-dev \
    libpq-dev \
    libxml2 \
    libxml2-dev \
    zip \
    libzip-dev \
    libxpm-dev \
    libvpx-dev 

ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 9.2.0

# Install nvm with node and npm
RUN curl https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash \
    && source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH      $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

WORKDIR /var/www/html

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install xml pdo_pgsql zip gd intl pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin \
    && php -r "unlink('composer-setup.php');" 

RUN curl -sS https://getcomposer.org/installer | php -- \
--install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer 

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Будет работать при условии, что создана БД и пользователь БД и настроен .env файл
# RUN composer update \
#     && php atisan migrate \
#     && php artisan db:seed --class=UserRolesSeeder \
#     && php artisan db:seed --class=SchoolchildrenUserRoleSeeder \
#     && php artisan db:seed --class=UserSeeder

ADD 010.php.ini /usr/local/etc/php/conf.d/
RUN usermod -u 1000 www-data