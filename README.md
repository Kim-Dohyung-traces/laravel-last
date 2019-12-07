# Laravel Project
![yju ac kr](https://user-images.githubusercontent.com/48374069/70375447-36bac580-1941-11ea-9cb3-1b2505947fa7.jpg)

## git bash
- $ git clone https://github.com/JunHyeok95/wdj6.git
- $ cd wdj6
- $ cp .env.example .env

- $ composer update
- $ composer install
- $ npm install

## mysql
- mysql> drop database wdj6;
- mysql> create database wdj6;

## .env 파일 수정 [ 다운받은 wdj6 폴더 ]
- DB_DATABASE= [ wdj6 ]
- DB_USERNAME= [ root ]
- DB_PASSWORD= [ password ]

- MAIL_DRIVER=smtp
- MAIL_HOST=smtp.gmail.com
- MAIL_PORT=587
- MAIL_USERNAME= [ gmail ]
- MAIL_PASSWORD= [ password ]
- MAIL_ENCRYPTION=tls

## php.ini 파일 수정 [ php 설치한 경로 ]
- ; extension=fileinfo [ 주석풀기 ]

## 실행 
- composer dump-autoload

- php artisan key:generate
- php artisan migrate
- php artisan db:seed

- php artisan serve [ --host=domain --port=8000 ]