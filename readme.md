This is an empty project with user roles, email confirmation and redirects set for you. 
Just follow these steps to get the project ready

1. run "composer install" in your project directory to get all dependencies
2. run "php artisan migrate" to create all the necessary tables for setting up user and roles
3. (optiona) run "php artisan db:seed" to add 2 roles ("Admin" and "User") and 1 admin user that I have created in the seed files
4. use your .env file, put correct email settings and database settings

Configuration
--------------------------------

In your .env file add this line:
LOGIN_ONLY_CONFIRMED=true

If the variable is true, the users won't be able to login without confirming their email first.
If you set the variable as false, the users can login without having to confirm their email by opening the confirmation link.
