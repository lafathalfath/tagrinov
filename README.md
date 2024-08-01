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
1. Master to your branch
   - click pull request
     <br/>![step1](https://github.com/user-attachments/assets/6c58ca37-852e-45ff-ab39-2dbad97344bb)
   - click new pull request
     ![step2](https://github.com/user-attachments/assets/a1d3deea-e483-46a0-91a1-1a2e9b1bfe7e)
   - set base to your branch name and compare to master
     ![step3](https://github.com/user-attachments/assets/49c43d23-e882-4051-be22-82b4cfd73613)
   - add a title and create pull request
     ![step4](https://github.com/user-attachments/assets/9530bfc7-2ec5-4d5c-b11c-0b36ef5831f3)
   - merge pull request
     ![step5](https://github.com/user-attachments/assets/541f104a-6ccf-42a3-bc9b-e7efbffde4bc)
   - confirm merge
     ![step6](https://github.com/user-attachments/assets/a976d97e-9d47-4486-b54a-d0012da9f690)
2. Your branch to master
   <br/>The steps is same as number 1 but you must set **base** to master and **compare** to your branch name
   ![merge](https://github.com/user-attachments/assets/d871b30e-8ad5-4de9-bfee-f7acb2f52612)
3. **Note**
   - Merge from **master** to **your branch** if the last merge to **master** was **not** from **your branch**.
   - You can merge from **your branch** to **master** if the last merge to **master** was from **your branch**.
