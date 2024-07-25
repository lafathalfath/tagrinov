# Contribution Guide

### Clone Project
1. Open terminal or git bash on directory you would like to store the project, and command:
   ```
   git clone https://github.com/lafathalfath/tagrinov.git
   ```

### Start Project
1. Copy and rename '.env.example' file ont root project to '.env', and configure your Database.
   example:
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```
2. Open terminal and command:
   - install dependencies
   ```
   cd tagrinov
   ```
   ```
   composer install
   ```
   - generate app key
   ```
   php artisan key:generate
   ```
   - migrate the database
   ```
   php artisan migrate --seed
   ```
   or
   ```
   php artisan migrate:fresh --seed
   ```

### Push
1. Make sure your local project is not on **master**. if it on master, change git branch:
   ```
   git branch -M <your-branch-name>
   ```
2. Stage change
   - stage all changes
   ```
   git add .
   ```
   - stage specific file
   ```
   git add -p <filename>
   ```
3. Commit changes
   ```
   git commit -m '<commit message>'
   ```
   **Commit message:**
     - 'CREATE: ...'
     - 'UPDATE: ...'
     - 'DELETE: ...'
     - 'FIX: ...'
4. Push changes
   ```
   git push -u origin <your-branch-name>
   ```

### Pull
1. Pull project from your branch
   ```
   git pull
   ```

### Merge
