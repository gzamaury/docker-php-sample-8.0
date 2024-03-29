#!/bin/bash

# update dependencies
echo "Updating Composer dependencies."
composer update

# Installing production dependencies
echo "Installing Composer dependencies for production."
export COMPOSER_VENDOR_DIR=./vendor
composer install --no-dev --no-interaction

# Wire from the src folder into the www folder
echo "Wiring the src folder into the /var/www/html folder."
echo "Start apache with: apache2ctl start"
sudo chmod a+x $(pwd)/src && sudo rm -rf /var/www/html && sudo ln -s $(pwd)/src /var/www/html