#!/usr/bin/env bash
chmod 755 -R *
chmod 777 -R ./storage/
chmod
composer install
php ./artisan migrate
