FROM php:7.3-apache

COPY . /var/www/html/
COPY .htaccess /var/www/html


RUN docker-php-ext-install mysqli bcmath && docker-php-ext-enable mysqli bcmath && apt-get update && apt-get install nano -y


RUN chmod -R 755 /var/www/html/
#RUN chown -R www-data:www-data /var/www/html/

RUN a2enmod rewrite
#CMD service apache2 restart



