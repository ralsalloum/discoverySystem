# Mars Discovery System
Symfony-based application for solving Mars discovery issue using rovers.

The interacting with the application is done via two approaches:
1. Console command (as described below).
2. RESTful API.

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
_Note: output will be displayed immediately after finish entering input for the questions
either by using console or the api_
### Provide input for the program via the command

```
php bin/console control-rovers
```

### Provide input for the program via api
```
Route: /v1/rovercontroller/managerovers, Method: PUT
```
```
Request (JSON):
{
	"upperRightCoordinates":"5 5", 
	"rovers":[
		{"location":{"x":3, "y":3, "d":"X"}, "movingInstructions":"LMLMLMLMMML"},
		{"location":{"x":1, "y":2, "d":"N"}, "movingInstructions":"MMRMMRMMRRM"}
	]
}
```

## Run Tests
_Unit tests are for the main functions of the program which related to
initializing the targeted area being discovered and updating the registered rovers coordinates._
### Run PHPUnit tests via the following command
```
php bin/phpunit
```

_NOTE:  
SOME CONFIGURATION FILES THAT ARE NOT RELATED TO THE PROJECT ARE EXIST JUST 
BECAUSE THERE WERE SOME BUNDLES INSTALLED_
