#!/usr/bin/env bash

composer install --no-dev --optimize-autoloader
composer dump-autoload -o
