**CLONE TO GET STARTED**
----
Clone this repository
Run the following commands

`composer install`

This is to install all the dependecies needed for the project to run

`php artisan key:generate`

This is to generate the key needed by laravel

Create a database and update the credentials in the .env file

```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_username
  DB_PASSWORD=your_database_password
```

`php artisan migrate`

This is to migrate the db


`php artisan serve`

To serve the application

    
 
