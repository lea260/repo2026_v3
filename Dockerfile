# Imagen base con PHP y Apache
FROM php:8.2-apache

# Instalar dependencias necesarias para MariaDB y Composer
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libmariadb-dev \
    unzip \
    git \
    curl

# Instalar extensiones de PHP para MariaDB
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Habilitar mod_rewrite en Apache (si usas .htaccess)
RUN a2enmod rewrite

# Copiar configuración personalizada de PHP
COPY php-config/php.ini /usr/local/etc/php/conf.d/custom.ini

# Copiar entrypoint personalizado


COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# --- ADD THESE DEBUG LINES ---
RUN ls -la /usr/local/bin/docker-entrypoint.sh
RUN cat /usr/local/bin/docker-entrypoint.sh
#RUN /usr/local/bin/docker-entrypoint.sh --help || echo "Entrypoint script is not directly executable yet or has no help option"
    # --- END DEBUG LINES ---

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Usar entrypoint personalizado
ENTRYPOINT ["docker-entrypoint.sh"]

# Exponer el puerto 80
EXPOSE 80
