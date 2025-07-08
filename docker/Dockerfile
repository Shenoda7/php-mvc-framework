# Start from an existing container that already has PHP 8.1 and Apache installed
FROM php:8.3-apache

# Take my custom Apache config file from my computer and put it inside the container where Apache expects to find it
COPY docker/php-mvc.conf /etc/apache2/sites-available/php-mvc.conf

# Enable mod_rewrite and your site config
RUN a2enmod rewrite && \
    a2ensite php-mvc.conf && \
    a2dissite 000-default.conf

# Install dependencies
RUN apt update && \
    apt install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Use built-in helper script from official PHP image to compile & enable extensions
RUN docker-php-ext-install zip pdo_mysql

# Copy custom Composer installer script into container
COPY docker/install-composer.sh ./

# Copy custom PHP config file to container (overrides default php.ini)
COPY docker/php.ini /usr/local/etc/php/

# Remove unneeded packages & temp files, then install Composer using script, and finally delete the script
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

# Copy your app code into the container
COPY . /var/www

# Set the working directory to the app directory
WORKDIR /var/www

# Set the owner of the app directory to the Apache user
RUN chown -R www-data:www-data /var/www

# Run the Apache server
CMD ["apache2-foreground"]