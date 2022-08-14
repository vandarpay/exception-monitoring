# Vandar Exception Monitoring Laravel Package

We need to define keys for each important section of the service.

When an exception occurs in a section, we need to add related key to redis and set a specific ttl to automatically remove the
keys.

Also, need an api with dynamic parameter for keys and return related response. api return 500 if the key exists in redis and 200
otherwise.

we must prepare some functionality that get key of important section and ttl from services and this package must provide a dynamic
route with dynamic parameter by the given key.

### Requirement

- Redis
- PHP redis extension

## Installation

### composer

```bash
composer require vandarpay/exception-monitoring
```

you can publish config file:

```bash
#config
php artisan vendor:publish --provider="VandarPay\ExceptionMonitoring\Providers\ExceptionMonitoringServiceProvider" --tag="config"
```

## Usage

Here's a quick example:

```php
use VandarPay\ExceptionMonitoring\Facades\ExceptionMonitoring;
    
    //...
    try{
        //...
        Mandate::store($data); // <--- this function will throw Exception
        //...
    } catch (Exception $exception){
        //...
        ExceptionMonitoring::set('mandate-store'); // <--- here we add important section key to redis
        //...
    }
    //...
 ```
**the default ttl for each key is 300s**. you can change that in `config/exception-monitoring.php`. or you can pass ttl as second argument in `set` function:
```php
ExceptionMonitoring::set('mandate-store',60); // this key will exist until 60 second.
```

there is a route with this pattern `/api/exception-monitoring/{key}`. 

for example if you call `https://your-domain.com/api/exception-monitoring/mandate-store` and,
 
if key exists in redis you will get bellow response:
```php
//status code = 500
"NOK"
```

or if key not exists in redis you will get bellow response:
```php
//status code = 200
"OK"
```

also you can remove key from redis manually like bellow:

```php
use VandarPay\ExceptionMonitoring\Facades\ExceptionMonitoring;

    ExceptionMonitoring::remove('mandate-store');
 ```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
