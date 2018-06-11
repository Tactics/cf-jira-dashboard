FROM clearfacts/cf-docker-base-php:1.0.12

# Add tools folder to image
ADD docker/dashboard/tools /tools
RUN chmod a+x /tools -R

# Add app code and make volume for mounting
ADD . /var/www
VOLUME [/var/www]
WORKDIR /var/www

# Install PHP vendor libs
RUN composer.phar install --no-ansi --no-interaction --no-progress --optimize-autoloader --profile --prefer-dist


