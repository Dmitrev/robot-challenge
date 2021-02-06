# robot-challenge
Forestation robot code challenge. The challenge is built using [PHP 8.0](https://www.php.net/releases/8.0/en.php)

## Requirements
- git
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (Docker engine version 19.03.0+)

## Install

```
git clone git@github.com:Dmitrev/robot-challenge.git
```

## Running application

To run simply execute from the project root

*Note: Make sure you are not running anything else on port **8080***

```
docker-compose up
```

Open your browser with the following url: http://localhost:8080

## Changing input data

In `src/app/Controller/Controller.php:15` you can change the input

**For random data (default)**
```php
// use this method for random data
$input = InputGenerator::random();
```

**For static data**
```php
// Override input with sample data
$input = InputGenerator::example();
```

You can also change the data however you like



```php
# robot-challenge/src/app/Service/InputGenerator.php

    public static function example(): string {
        return <<<EOL
        5 3
        1 1 E
        RFRFRFRF
        3 2 N
        FRRFLLFFRRFLL
        0 3 W
        LLFFFLFLFL
        EOL;
    }
```


