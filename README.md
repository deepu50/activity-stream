# activity-stream
step-1:after cloning the project from git do composer update
step-2 create a database and update it in the env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=activity_stream
DB_USERNAME=root
DB_PASSWORD=

step-2:php artisan migrate
step-3:php artisan serve
step-4:A user has to be registered in order to login the dashboard .
