# Laravel IDEABIZ Handler (Laravel 5.5+)
Laravel IDEABIZ Handler is a laravel plugin to handle REST API request for [IDEABIZ](http://www.ideamart.lk/ideaBiz.html) APIs 

## Requirements

* PHP 5.6+
* Laravel 5.5+

## Installation

1) Install the package by running this command in your terminal/cmd:
```
composer require dasun4u/laravel-ideabiz-handler
```

2) Optionally, you can import config file by running this command in your terminal/cmd:
```
php artisan vendor:publish --provider="Dasun4u\LaravelIDEABIZHandler\RestAPIProvider"
```

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
