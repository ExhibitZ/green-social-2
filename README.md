# Green Social
social media for climate change

## Getting Started
fork project ini

Run <code>git clone https://github.com/YOUR-USERNAME/green-social.git</code>

Run <code>cd green-social</code>

Run <code>composer install</code>

Run <code>cp .env.example .env</code>

Run <code>php artisan key:generate</code>

Run <code>code .</code>

ganti setting .env database jadi ini

DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=green_social_db<br>
DB_USERNAME=root<br>
DB_PASSWORD=

nyalakan xampp mysql & apache

Run <code>php artisan migrate</code>

Run <code>php artisan db:seed</code>

Run <code>php artisan storage:link</code>

Run <code>php artisan serve</code>
