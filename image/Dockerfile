FROM php:5.6-apache

# Install unzip and mysqli drivers for php
RUN set -ex; \
  apt-get update; \
  apt-get install -y unzip; \
  rm -rf /var/lib/apt/lists/* ; \
  docker-php-ext-install mysqli; \
  a2enmod rewrite; \
  curl -o /tmp/tematres.zip -L 'https://github.com/tematres/TemaTres-Vocabulary-Server/archive/master.zip'; \
  unzip /tmp/tematres.zip -d /tmp; \
  cd /var/www/html; \
  ( cd /tmp/TemaTres-Vocabulary-Server-master && tar cf - . ) | tar xvf - ; \
  rm -rf /tmp/tematres.zip /tmp/TemaTres* ;
