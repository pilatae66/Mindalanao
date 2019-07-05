@ECHO OFF
TITLE APPLICATION INITIALIZATOR
ECHO Application Start Process Initiated
ECHO Installing composer dependencies
CALL composer install
ECHO Installing npm dependencies
CALL npm install
ECHO Copying .env file
CALL copy .env.example .env
ECHO generating application key...
CALL php artisan key:generate
echo Creating Database, migrating tables and seeding default data
call php artisan migrate:fresh --seed
ECHO Initialization done!
cd vendor/laravel/framework/src/Illuminate/Foundation/Auth/
start notepad AuthenticatesUsers.php
cd ../../../../../../..
start CCSSMS.bat