#NowDeals Member and Admin Portal

Clone Repo in web page folder (/var/www/html) and rename nowdeals-member to nowdeals (PHPMailer refers to this path near SMTP info)

Run 'composer update' to bring in sweb3-php files

Set your database info and admin pwd in ndconf.php

Set your SMTP info in ndsmtp.php

Create a mariadb database: nowdeals

Create a mariadb table from nowdeals.sql
