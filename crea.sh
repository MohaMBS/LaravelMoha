
composer create-project laravel/laravel $1

cd $1

chmod -R 777 storage/logs/ 

composer require laravel/breeze --dev

chmod -R 777 storage/logs/ 

php artisan breeze:install

chmod -R 777 storage/logs/ 

npm install && npm run dev

chmod -R 777 storage/logs/ 
