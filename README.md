# NowDeals Member and Admin Portal

Clone Repo in web page folder (/var/www/html) and rename nowdeals-member to nowdeals (PHPMailer refers to this path near SMTP info)

Run 'composer update' to bring in sweb3-php files (PHPMailer files included, no composer needed)

Set your database info and admin pwd in ndconf.php

Set your SMTP info in ndsmtp.php

Create a mariadb database: nowdeals

Create a mariadb table from nowdeals.sql

Crypto transactions are based on Tether USDT using the Polygon Network

USDT info obtained using polygonscan.com API

USDT transfers using sweb3-php

