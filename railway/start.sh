#!/bin/bash
set -e
export PORT=${PORT:-8000}
php artisan migrate --force 2>/dev/null || true
php artisan config:cache
php artisan storage:link 2>/dev/null || true
exec php artisan serve --host=0.0.0.0 --port=$PORT
