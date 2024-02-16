## How to install My Blog

Install all modules :

composer install   
npm install

Duplicate .env.example, rename it .env and change those values (with your custom ones) :

DB_CONNECTION=mysql   
DB_HOST=127.0.0.1   
DB_PORT=3306   
DB_DATABASE=my_blog   
DB_USERNAME=yourUserName   
DB_PASSWORD=yourPWD   

Then create and seed your DB with :

php artisan migrate --seed

Finally let's start the dev server :

npm run dev   
php artisan serve