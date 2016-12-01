Laravel 5.3 is amazing, but it needs some other things in it's starting project to be more awesome. I have added and improved many things for my started laravel template project, so I thought of helping other developers by posting this. You are invited to add other things here, or improve my code.

What is added?
--------------------------------
  1. User roles system like .NET Identity 2. You can use the roles middleware and set the allowed users for each action/route
  2. Email confirmation is sent after the user is registered and also the route and logic for confirming the account 
  3. ReturnUrl is added to the authentification logic which means that if a user tries to open a route like "/news" and that route requires him to be logged in some certain role, the user is redirected to the login page. After logging in he is redirected back to the /news page.
  4. NoCache Middleware is added and you can use it for development. Just uncomment it on your app/http/kernel.php file.
  5. Artisan droptables command is added. It does exactly what it says, drops all your database tables and then you can migrate from scratch
  6. Dynamic truncateAll method added to DatabaseSeeder. All the tables created by your migration files will be made empty when the function is called before you seed new data.
  7. Tymon JWT package is added, registered and JWT is used as default authentification driver for API routes together with my roles middleware. Example API routes are included with authentification route to get the token and another example route that uses both roles and needs the token.
    
Installation
--------------------------------
1. run "composer install" in your project directory to get all the dependencies
2. run "php artisan migrate" to create all the necessary tables for setting up user and roles
3. (optiona) run "php artisan db:seed" to add 2 roles ("Admin" and "User") and 1 admin user that I have created in the seed files
4. put correct email settings and database settings in your .env file
5. run "php artisan jwt:generate" to create secret key used to sign the tokens for the api routes, more config is found on config/jwt.php

Configuration
--------------------------------

In your .env file add this line:
LOGIN_ONLY_CONFIRMED=true

If the variable is true, the users won't be able to login without confirming their email first.
If you set the variable as false, the users can login without having to confirm their email by opening the confirmation link.
