FROM ubuntu:16.04
MAINTAINER Dan Pupius <dan@pupi.us>

# Install apache, PHP, and supplimentary programs. openssh-server, curl, and lynx-cur are for debugging the container.
RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y apache2 php7.0 php7.0-mysql libapache2-mod-php7.0 curl lynx-cur

# Enable apache mods.
RUN a2enmod php7.0
RUN a2enmod rewrite

# Update the PHP.ini file, enable <? ?> tags and quieten logging.
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

RUN mkdir /var/www/js

# Expose apache.
EXPOSE 80

# Copy this repo into place.
COPY image_files/data.php /var/www/html/data.php
COPY image_files/index.php /var/www/html/index.php 
COPY image_files/data_bar.php /var/www/html/data_bar.php
COPY image_files/index_bar.php /var/www/html/index_bar.php 
COPY image_files/json.php /var/www/html/json.php
COPY image_files/js/Chart.min.js /var/www/html/js/Chart.min.js 
COPY image_files/js/jquery.min.js /var/www/html/js/jquery.min.js


# Update the default apache site with the config we created.
#ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
CMD /usr/sbin/apache2ctl -D FOREGROUND
