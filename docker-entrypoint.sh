#!/bin/bash

# update dependencies
echo "Updating Composer dependencies."
composer update

# Installing production dependencies
echo "Installing Composer dependencies for production."
export COMPOSER_VENDOR_DIR=./vendor
composer install --no-dev --no-interaction