#!/bin/bash

echo "=== COMPREHENSIVE CACHE CLEARING ==="

# Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan queue:restart

# Clear compiled files
php artisan clear-compiled

# Clear application cache
php artisan optimize:clear

# Restart queue workers
php artisan queue:restart

# Clear OPcache if available
if command -v php &> /dev/null; then
    php -r "if (function_exists('opcache_reset')) { opcache_reset(); echo 'OPcache cleared\n'; } else { echo 'OPcache not available\n'; }"
fi

echo "=== ALL CACHES CLEARED ==="