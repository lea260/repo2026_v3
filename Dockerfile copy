# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para MariaDB
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libmariadb-dev

# Instalar extensiones de PHP para MariaDB
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Habilitar mod_rewrite en Apache (si usas .htaccess)
RUN a2enmod rewrite

# Copiar configuración personalizada de PHP
COPY php-config/php.ini /usr/local/etc/php/conf.d/custom.ini

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto 80
EXPOSE 80
