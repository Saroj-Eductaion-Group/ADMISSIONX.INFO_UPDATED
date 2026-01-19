@echo off
echo === COMPREHENSIVE CACHE CLEARING ===

REM Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan queue:restart

REM Clear compiled files
php artisan clear-compiled

REM Clear application cache
php artisan optimize:clear

REM Restart queue workers
php artisan queue:restart

echo === ALL CACHES CLEARED ===
pause