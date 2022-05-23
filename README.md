# integrityChallenge
My first time using Docker, Composer and Symfony. A great motivation and opportunity to learn!


In this project I made  CLI Application that first checks wheter a URL is valid, if so it saves the final URL into DB and and also it Headers.
Due to my lack of experience with Symfony I couldn't manage to make the web app but I certainly will make it soon.

Steps

1) Clone this repository and CD to the cloned Directory

2) At terminal Run: docker-compose up

3) At terminal Run: docker exec -it <service_id> bash

4) At terminal Run: cd bin

5) At terminal (if requested when trying to run any command like: php bin/console list) Run: composer require symfony/runtime


6) In order for this project work the 'integrityChalenge' DataBase(schema) must be created with the following tables:

 -- This project uses MariaDB --

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

7) You're ready to run the command:  php bin/console app:URL <your_URL>
8) In order to confirm that the record was added into db you can run "php bin/console dbal:run-sql 'SELECT * FROM request'"
