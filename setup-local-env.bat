@echo off
echo Setting up Little Miami Brewing Company WordPress site...

REM Check if XAMPP is installed
if not exist "C:\xampp" (
    echo Please install XAMPP first from https://www.apachefriends.org/download.html
    pause
    exit
)

REM Create project directory in htdocs
if not exist "C:\xampp\htdocs\little-miami-brewing-company" (
    mkdir "C:\xampp\htdocs\little-miami-brewing-company"
)

REM Copy project files
xcopy /E /I /Y "e:\Aryan Projects\Little Miami Brewing Company\*" "C:\xampp\htdocs\little-miami-brewing-company"

REM Create wp-config.php if it doesn't exist
if not exist "C:\xampp\htdocs\little-miami-brewing-company\wp-config.php" (
    echo Creating wp-config.php...
    (
        echo ^<?php
        echo // ** Database settings ** //
        echo define^('DB_NAME', 'littlemiami'^);
        echo define^('DB_USER', 'root'^);
        echo define^('DB_PASSWORD', ''^);
        echo define^('DB_HOST', 'localhost'^);
        echo define^('DB_CHARSET', 'utf8mb4'^);
        echo define^('DB_COLLATE', ''^);
        echo.
        echo define^('AUTH_KEY',         'put your unique phrase here'^);
        echo define^('SECURE_AUTH_KEY',  'put your unique phrase here'^);
        echo define^('LOGGED_IN_KEY',    'put your unique phrase here'^);
        echo define^('NONCE_KEY',        'put your unique phrase here'^);
        echo define^('AUTH_SALT',        'put your unique phrase here'^);
        echo define^('SECURE_AUTH_SALT', 'put your unique phrase here'^);
        echo define^('LOGGED_IN_SALT',   'put your unique phrase here'^);
        echo define^('NONCE_SALT',       'put your unique phrase here'^);
        echo.
        echo $table_prefix = 'wp_';
        echo.
        echo define^('WP_DEBUG', true^);
        echo.
        echo if ^( !defined^('ABSPATH'^) ^) {
        echo     define^('ABSPATH', dirname^(__FILE__^) . '/'^);
        echo }
        echo.
        echo require_once ABSPATH . 'wp-settings.php';
    ) > "C:\xampp\htdocs\little-miami-brewing-company\wp-config.php"
)

echo Setup complete!
echo.
echo Please follow these steps:
echo 1. Start XAMPP Control Panel and start Apache and MySQL
echo 2. Open your browser and go to http://localhost/phpmyadmin
echo 3. Create a new database named "littlemiami"
echo 4. Visit http://localhost/little-miami-brewing-company to complete WordPress installation
echo.
pause
