## Back-end app (API) of Appetiser App Coding Challenge

This a is a simple event calendar web app for coding challenge on Appetise

## Project Setup
1. After cloning the repository, create a `.env` file using `.env.example`
2. Run `composer install`
3. Create database and save the database name and credentials on your `.env` file
4. Run `php artisan key:generate` to generate application keys
5. Run `php artisan migrate` to migrate the tables to your database
6. Serve the API `php artisan serve`