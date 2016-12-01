What is added?
--------------------------------
  1. User roles system like .NET Identity 2. You can use the roles middleware and set the allowed users for each action/route
  2. Email confirmation is sent after the user is registered and also the route and logic for confirming the account (check configuration too)
  3. ReturnUrl is added to the roles middleware which means that if a user tries to open a route like "/news" and that route requires him to be logged in some certain role, the user is redirected to the login page. After logging in he is redirected back to the /news page.
  4. NoCache Middleware is added and is very useful for developement. It is located in the app/http/kernel just uncomment it
  5. php artisan droptables command is added. It does exactly what it says, drops all your database tables and then you can migrate from scratch
  6. Dynamic truncateAll method added to DatabaseSeeder. All the tables created by your migration files will be made empty when the function is called before you seed new data.
  7. Tymon JWT package added as default authentification driver for api routes together with my roles middleware. Example routes are included
    
Just follow these steps to get the project ready

Installation
--------------------------------
1. run "composer install" in your project directory to get all dependencies
2. run "php artisan migrate" to create all the necessary tables for setting up user and roles
3. (optiona) run "php artisan db:seed" to add 2 roles ("Admin" and "User") and 1 admin user that I have created in the seed files
4. use your .env file, put correct email settings and database settings
5. php artisan jwt:generate to create secret key used to sign the tokens for the api routes
Configuration
--------------------------------

In your .env file add this line:
LOGIN_ONLY_CONFIRMED=true

If the variable is true, the users won't be able to login without confirming their email first.
If you set the variable as false, the users can login without having to confirm their email by opening the confirmation link.