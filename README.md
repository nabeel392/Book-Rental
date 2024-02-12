Installation guide

To set up a Laravel project you'll need to follow these general steps:

1. Transfer your Laravel project files in xampp/htdocs folder.
2. Navigate to the root directory of your Laravel project using the command line and run "composer install" to install all the dependencies defined in your composer.json file.
3. Run "php artisan key:generate" to generate an application key for your Laravel project.
4. If your project uses a database, run the migrations to create the necessary tables. Use "php artisan migrate" command for this then write yes for your database to be created.
5. For books i have created books seeder factory so run command "php artisan db:seed --class=BooksTableSeeder".
6. Run "php artisan serve" command to run the project.
7. In the .env file you need to change here like 

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your gmail username
MAIL_PASSWORD=your gmail password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}" 

i had my personal email setup here so i can not gve those credentials so,
In here you need to put your gmail username and the password you can get from 2 step verification then app passwords there you can get 16 digits password you have to put that here for email sending. 
