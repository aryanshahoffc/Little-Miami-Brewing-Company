@echo off
echo Preparing WordPress files for deployment...

REM Create a deployment directory
mkdir "e:\Aryan Projects\Little Miami Brewing Company\deployment"

REM Copy WordPress files
xcopy /E /I /Y "e:\Aryan Projects\Little Miami Brewing Company\*" "e:\Aryan Projects\Little Miami Brewing Company\deployment"

REM Export database
echo Please follow these steps to export your database:
echo 1. Open your web browser
echo 2. Go to http://localhost/phpmyadmin
echo 3. Click on 'littlemiami' database
echo 4. Click 'Export' at the top
echo 5. Choose 'Quick' export method
echo 6. Click 'Go'
echo 7. Save the file as 'littlemiami.sql' in the deployment folder

echo.
echo After exporting the database, follow these steps:
echo 1. Go to Bluehost.com and create an account
echo 2. Purchase a hosting plan (Choice Plus recommended for WordPress)
echo 3. Register your domain (e.g., littlemiamibrewing.com)
echo 4. Wait for the confirmation email from Bluehost

pause

echo.
echo Once you have your Bluehost account:
echo 1. Log in to Bluehost control panel
echo 2. Go to 'Advanced' section
echo 3. Find 'FTP Accounts' and create a new FTP account
echo 4. Use an FTP client (like FileZilla) to upload files
echo 5. Import the database using phpMyAdmin in Bluehost

pause
