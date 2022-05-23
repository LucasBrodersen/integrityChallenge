# integrityChallenge
My first time using Docker, Composer and Symfony. A great motivation and opportunity to learn!


In this project I made  CLI Application that first checks wheter a URL is valid, if so it saves the final URL into DB and and also it Headers.
Due to my lack of experience with Symfony I couldn't manage to make the web app but I certainly will make it soon.

Steps

1) Clone this repository

2) At terminal Run: docker-compose up

3) At terminal Run: docker exec -it <service_id> bash

4) At terminal Run: cd bin

%) At terminal (if requested to run any command) Run: composer require symfony/runtime


In order for this project work the 'integrityChalenge' DataBase(schema) must be created with the following tables:

![image](https://user-images.githubusercontent.com/89182998/169781351-c3c4a076-31f5-4b6b-ac0f-e7c3cfd80660.png)

!Importat: You can run the code below to generate the needed table (Please make sure you select 'integrityChalenge' schema).

create table doctrine_migration_versions
(
    version        varchar(191) not null
        primary key,
    executed_at    datetime     null,
    execution_time int          null
)
    collate = utf8mb3_unicode_ci;

create table final_headers
(
    id           int auto_increment
        primary key,
    final_url    varchar(255) not null,
    headers      varchar(255) not null,
    header_value longtext     not null
)
    collate = utf8mb4_unicode_ci;

create table request
(
    id        int auto_increment
        primary key,
    first_url varchar(255) not null,
    final_url varchar(255) not null,
    date_time varchar(30)  not null
)
    collate = utf8mb4_unicode_ci;

