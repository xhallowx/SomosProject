# Usa la imagen oficial de PHP 8.2 con FPM
FROM php:8.2-fpm

# Actualiza los repositorios e instala las dependencias de sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configura y compila la extensión gd con soporte para Freetype y JPEG
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala las extensiones PHP necesarias:
# - pdo_pgsql: para conectar con PostgreSQL
# - mbstring, exif, pcntl, bcmath, gd: para funcionalidades comunes en Laravel
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Copia Composer desde la imagen oficial de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia el código de la aplicación al contenedor
COPY . /var/www

# Instala las dependencias de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Ajusta los permisos para que www-data (el usuario de PHP-FPM) sea el dueño de la aplicación
RUN chown -R www-data:www-data /var/www

# Expone el puerto que utilizará PHP-FPM (usualmente el 9000)
EXPOSE 9000

# Comando por defecto para iniciar PHP-FPM
CMD ["php-fpm"]
