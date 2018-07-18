#!/usr/bin/env bash
# This let the script fail when a subcommand fails, container won't start so we will notice something went wrong
set -e

# fix key permissions voor oauth2 (CryptKey.php checks)
mkdir /var/www/keys
cp /var/www/secrets/*.key /var/www/keys
chgrp www-data /var/www/keys/*.key
chmod 660 /var/www/keys/*.key

# Show the secret folder contents
find /var/www/keys

cat /var/www/secrets/parameters.yml

# clean cache folders, but leave the bootstrap.cache in /var/cache
rm -rf var/cache/*/

# prepare all the things
php -d memory_limit=512M bin/console cache:warmup --env=stage
php -d memory_limit=512M bin/console cache:warmup --env=prod
php -d memory_limit=512M bin/console fos:js-routing:dump --env=stage --target="web/js/fos_js_routes.stage.js"
php -d memory_limit=512M bin/console fos:js-routing:dump --env=prod --target="web/js/fos_js_routes.prod.js"
php -d memory_limit=512M bin/console translations:csv-to-frontend --env=prod
php -d memory_limit=512M bin/console assets:install --env=prod
php -d memory_limit=512M bin/console assetic:dump --env=prod
chmod -R 777 var/cache
chmod -R 777 var/logs
chown -R 1000:1000 var/cache
chown -R 1000:1000 var/logs

# (re)build bootstrap file
composer.phar run-script post-update-cmd

# copy web files to shared volume for nginx
export nginxVolume=/var/web-volume-for-nginx
if [ -d "$nginxVolume" ]; then
  echo "Copy files to $nginxVolume"
  cp -Rp /var/www/web/. $nginxVolume
else
  echo "$nginxVolume not found"
  exit 1
fi

# go nuts
/usr/local/sbin/php-fpm
