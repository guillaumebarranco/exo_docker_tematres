FROM php:5.6-apache # This command takes an existing image on Docker Hub as the base image of the build

# Install unzip and mysqli drivers for php
RUN set -ex; \
  apt-get update; \ # This basic command make the updates for the apt-get package manager to be up to date and ready to install packages
  apt-get install -y unzip; \ # This command installs with apt-get package manager the unzip package to decompress zip files
  rm -rf /var/lib/apt/lists/* ; \ # This command removes the existing apt lists because we do not use them
  docker-php-ext-install mysqli; \ # This command adds mysqli driver to docker to be usable in the image
  a2enmod rewrite; \ # This command enables the mod_rewrite apache2 module
  curl -o /tmp/tematres.zip -L 'https://github.com/tematres/TemaTres-Vocabulary-Server/archive/master.zip'; \ # We download with a cURL the tematres zip
  unzip /tmp/tematres.zip -d /tmp; \ # With the previously installed unzip package, we decompress the tematres.zip
  cd /var/www/html; \ # we move to the basic apache working directory
  ( cd /tmp/TemaTres-Vocabulary-Server-master && tar cf - . ) | tar xvf - ; \ # We test if the tmp/tematres folder exists and zip then unzip it to /var/www/html
  rm -rf /tmp/tematres.zip /tmp/TemaTres* ; # Then we remove the tematres zip in tmp folder because we have no use for it anymore

COPY db.tematres.php /var/www/html/vocab/db.tematres.php # We move our tematres php file to the inside of the container
