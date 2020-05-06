[![Latest Stable Version](https://poser.pugx.org/dasun4u/laravel-ideabiz-handler/v/stable)](https://packagist.org/packages/dasun4u/laravel-ideabiz-handler)
[![Total Downloads](https://poser.pugx.org/dasun4u/laravel-ideabiz-handler/downloads)](https://packagist.org/packages/dasun4u/laravel-ideabiz-handler)
[![License](https://poser.pugx.org/dasun4u/laravel-ideabiz-handler/license)](https://packagist.org/packages/dasun4u/laravel-ideabiz-handler)
[![StyleCI](https://github.styleci.io/repos/126970369/shield?branch=master)](https://github.styleci.io/repos/126970369)

# Laravel IDEABIZ Handler (Laravel 6.0+)
Laravel IDEABIZ Handler is a laravel plugin to handle REST API request for [IDEABIZ](http://www.ideamart.lk/ideaBiz.html) APIs 

## Requirements

* PHP 7.0+
* Laravel 6.0+

## Installation

1) Install the package by running this command in your terminal/cmd:
```
composer require dasun4u/laravel-ideabiz-handler
```

2) You can import config file and sample token file by running this command in your terminal/cmd:
```
php artisan vendor:publish --provider="Dasun4u\LaravelIDEABIZHandler\RestAPIProvider"
```

3) Then set the configurations in **ideabiz.php** file.

4) For the first time, token generate using **'grant_type' => 'password'** or manualy.
Verify that **token.json** file has the valid access token and refresh token

It has following functions:
* Generate access token
```php
IDEABIZ::generateAccessToken();
```

* Get access token
```php
IDEABIZ::getAccessToken();
````

* Make the request
```php
$access_token = IDEABIZ::getAccessToken();
$url = "https://ideabiz.lk/apicall/xyz"
$method = "POST";
$headers = [
                "Content-Type" => "application/json",
                "Authorization" => "Bearer ".$access_token,
                "Accept" => "application/json",
           ];
$request_body = [
                    "a" => 123,
                    "b" => "xyz",
                ];
 
// Rest API request and response get to a variable                
$response = IDEABIZ::apiCall($url, $method, $headers, $request_body);

// Get response body
$response->getBody();

// Get status code
$response->getStatusCode();

// Get response headers
$response->getHeaders();
```

## Author

* [**Dasun Dissanayake**](https://github.com/dasun4u)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Special Thanks to

* [Laravel](https://laravel.com) Community
