FROM php:8.2-apache

RUN echo "DirectoryIndex login.php" >> /etc/apache2/apache2.conf

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html

EXPOSE 80
