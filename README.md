
## Installation
Install mysql

Install a web server

Clone ZombieSource repo to the root of your webserver

Create mysql table with this schema /www/db/ddl.sql

Edit /www/application/config.php so that $config['base_url'] is set to the full local path to ZombieSource

e.g. config['base_url']  = 'http://localhost:8888/ZombieSource/www/';

Edit /www/application/database.php with the login credentials for your local mysql installation.
## Contributing

Open a pull request to obtain a code review. Don't commit anything you changed under/config that is only for your local enviorment. 