#!/bin/bash
set -e
php artisan migrate --force
php artisan config:cache
php artisan storage:link || true
php artisan route:cache || true
