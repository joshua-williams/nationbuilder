# nationbuilder
Nation Builder Application

### Requirements ###

* PHP 5.4+
* Apache 2.4 - rewrite, mcrypt, curl
* Composer
* NodeJS
* Grunt


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

#### Run grunt ####
```
grunt
```

#### Configure Apache virtual host ####
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
