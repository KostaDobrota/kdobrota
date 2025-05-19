@echo off
echo Checking database existence and required tables...

REM Create .env file if it doesn't exist
if not exist .env (
    echo Creating .env file...
    (
        echo APP_NAME=Laravel
        echo APP_ENV=local
        echo APP_DEBUG=true
        echo APP_URL=http://localhost
        echo.
        echo DB_CONNECTION=mysql
        echo DB_HOST=127.0.0.1
        echo DB_PORT=3306
        echo DB_DATABASE=kdobrota
        echo DB_USERNAME=root
        echo DB_PASSWORD=
    ) > .env
    echo .env file created successfully
)

REM Check MySQL connection and create database
echo Checking MySQL connection...
mysql -u root --execute="SELECT 1" > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo Error: Cannot connect to MySQL. Please make sure XAMPP MySQL service is running.
    exit /b 1
)

REM Create database with proper character set
echo Creating/Checking database 'kdobrota'...
mysql -u root --execute="CREATE DATABASE IF NOT EXISTS kdobrota CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
if %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to create database.
    exit /b 1
)

echo Installing Composer dependencies...
call composer install

echo Checking application key...
php artisan key:status > nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo Generating application key...
    php artisan key:generate
)

echo Clearing all Laravel caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo Running database migrations and seeders...
php artisan migrate:fresh
php artisan db:seed

echo Checking storage link...
if not exist "public\storage" (
    echo Creating storage link...
    php artisan storage:link
)

echo Installing NPM dependencies...
call npm install

echo Building assets...
call npm run build

echo Starting PHP server on localhost:8000...
echo You can now access the application at http://localhost:8000
php artisan serve 