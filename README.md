

Clone repository, bisa di download .zip atau dengan perintah git clone

DATABASE CONFIGURATION
______________________

1. Buat database di phpMyAdmin
2. Buka file .env dan ubah DB_Name sesuai database yang dibuat

APPLICATION CONFIGURATION
_________________________
1. Install Composer 
2. Run command "php artisan migrate"
3. Run Command "php artisan db:seed"
4. Run Local Server

composer install
Edit pengaturan database di file .env, juga masukkan perintah ini untuk mengisi APP_KEY
php artisan key:generate
Migrasi tabelnya ke database dengan perintah
php artisan migrate
Lalu masukkan perintah berikut untuk insert beberapa data ke database

php artisan db:seed
Siap dijalankan...