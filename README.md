

Clone repository, bisa di download .zip atau dengan perintah git clone seperti ini
Pada cmd, pindah ke folder prognet8 contohnya
cd c:/xampp/htdocs/prognet8
lalu instal composer

composer install
Edit pengaturan database di file .env, juga masukkan perintah ini untuk mengisi APP_KEY
php artisan key:generate
Migrasi tabelnya ke database dengan perintah
php artisan migrate
Lalu masukkan perintah berikut untuk insert beberapa data ke database

php artisan db:seed
Siap dijalankan...