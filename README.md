# Mars Discovery System
Symfony-based application for solving Mars discovery issue using rovers.

The interacting with the application is done via the console command.

Input values are entered as answers for couple questions, and immediately 
an output will be displayed on the same console (if the input is valid and no exceptions
are exists).

## What used?
* Symfony framework version 6.0.4
* PHP 8.0
* PHPUnit 9.5.26
* Docker

## Project setup

### Composer setting
```
composer update
```


## User Guide
### Provide input for the program via the command
_Note: output will be displayed immediately after finish entering input for the questions_
```
php bin/console control-rovers
```

## Run Tests
### Run PHPUnit tests via the following command
```
php bin/phpunit
```

_NOTE:  
SOME CONFIGURATION FILES THAT ARE NOT RELATED TO THE PROJECT ARE EXIST JUST 
BECAUSE THERE WERE SOME BUNDLES INSTALLED_
