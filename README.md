https://computer.yju.ac.kr/

## git bash
- $ git clone https://github.com/JunHyeok95/wdj6.git
- $ cd wdj6
- $ cp .env.example .env

- $ composer update
- $ composer install
- $ npm install

## mysql
- drop database wdj6;
- create database wdj6;

## wdj6/.env   [ data update ]
- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=

- MAIL_DRIVER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_USERNAME= [ gmail ]
- MAIL_PASSWORD= [ password ]
- MAIL_ENCRYPTION=tls

## php.ini 파일 수정
- extension=fileinfo [ 주석풀기 ]

## 실행 
- composer dump-autoload

- php artisan key:generate
- php artisan migrate
- php artisan db:seed

- php artisan serve [ --host=domain --port=8000 ]