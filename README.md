# BlogsApp

Simple project with protected blog section for only subscribers and once the subscriber
logged in for the first time it can’t login from other device in the future


## Technologies
- Laravel framework 8 - php version: 7.3.21
- MySql
- Yajra Datatable for laravel
- JQuery Datatable
- Bootstrap 5

## Steps to run the project
- Run "composer install" after downloading the project from my github repository, to install laravel framework with its packages
- Create database (name is "blogs_app", which is set in config/database.php)
- Run "php artisan migrate" to create tables in the database. (please see database/migrations directory for details)
- Run "php artisan db:seed" to fill users table with data. (please see UserFactory in database/factories directory for details)
- Now, you can login as admin with username : "admin.admin" and password : "admin"
  you will see "home" view 
- Then, you can move to the "Control Panel" by clicking on "Control Panel" button that exists in profile dropdown on the right top of the page


## Notes
- There is two types of users: "admin" & "subscriber", so I have created a middleware called "CheckAdmin" to filter users and authorize the access to the control panel
- `- The logged in subscriber can’t login from other device after the first login (NOT IP)` I handled it by saving "user_agent" for the user on the first login
and compared it with the current user agent each time on login. (please see LoginController for details)
