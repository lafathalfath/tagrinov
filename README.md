# How To Clone

1. Open terminal or git bash on directory you would like to store the project, and command:
   ```
   git clone https://github.com/lafathalfath/tagrinov.git
   ```
2. Copy and rename '.env.example' file ont root project to '.env', and configure your Database.
   example:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Open terminal again and command:
   - install dependencies
   ```
   cd tagrinov
   ```
   ```
   composer install
   ```
   - migrate the database
   ```
   php artisan migrate --seed
   ```
   or
   ```
   php artisan migrate:fresh --seed
   ```
4. Change git branch
   ```
   git branch -M [your-branch-name]
   ```
