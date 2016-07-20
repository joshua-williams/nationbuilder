# nationbuilder
Nation Builder Application

### Requirements ###

* PHP 5.4+
* Apache 2.4 - rewrite, mcrypt, curl
* Composer
* NodeJS 

## Installation ##

#### Create a new nationbuilder configuration file. ####

./config/nationbuilder.php

``` 
<?php 

return [
	'nations' => [
		'my_nation' => ['token' => 'the_access_token_for_your_nation']
	]
]

?>
```

#### Run composer install from application root ####
```
composer install
```

#### Install Node modules (Grunt and Bower) ####
```
npm install
```

#### Download front end dependencies ####
```
bower install
```

#### Run grunt to move bower components to public folder ####
```
grunt
```

## Setting Up Webserver ##

#### PHP cli-server ####

The quickest way to run this is with the built in php webserver. From the command line run
```
php -S 0.0.0.0:8080 -t /path/to/nationbuilder/application/public
```
Update ./config/config.php changing the site_url to "localhost:8080"

#### Apache virtual host ####
```
<VirtualHost *:80>
  ServerName dev.nationbuilder
  DocumentRoot /var/www/vhosts/nationbuilder/public
  <Directory /var/www/vhosts/nationbuilder/public>
    Require all granted
    AllowOverride all
  </Directory>
</VirtualHost>
```
