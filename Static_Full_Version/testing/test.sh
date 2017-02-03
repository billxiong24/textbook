#!/bin/bash
[[ "$#" -lt 1 ]] && { echo "Input test file"; exit 1; }
php -c /var/www/html/php.ini $(which phpunit) "$@" 
