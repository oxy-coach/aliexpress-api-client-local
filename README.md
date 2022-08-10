[![Build Status](https://github.com/oxy-coach/aliexpress-api-client-local/workflows/ci/badge.svg)](https://github.com/retailcrm/aliexpress-top-client/actions)
[![Latest stable](https://img.shields.io/packagist/v/oxy-coach/aliexpress-api-client-local.svg)](https://packagist.org/packages/oxy-coach/aliexpress-api-client-local)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/oxy-coach/aliexpress-api-client-local.svg)](https://packagist.org/packages/oxy-coach/aliexpress-api-client-local)

# AliExpress API client for new API version
API client implementation for AliExpress local API.

## Usage
1. This library uses `php-http/httplug` under the hood. If you don't want to bother with details, just install library and it's dependencies via Composer:
```sh
composer require php-http/curl-client nyholm/psr7 php-http/message retailcrm/aliexpress-top-client
```
Details about those third-party libraries and why you need to install them can be found [here](http://docs.php-http.org/en/latest/httplug/users.html).

2. Instantiate client using `ClientFactory`:
```php
use Simla\Component\AppData;
use Simla\Factory\ClientFactory;

$client = ClientFactory::createClient(
    AppData::ENDPOINT,
    'your jwt token'
);
```

3. Create and fill request data. All requests and responses use the same naming. Requests live under `RetailCrm\Model\Request` namespace, and responses can be found in the `RetailCrm\Model\Response` namespace.
   For example, you can instantiate an **order list request** with this code:
```php
use Simla\Model\Request\GetOrderListRequest;

$request = new GetOrderListRequest();
```
4. Send request using `Client::sendRequest` like this:
```php
/** @var \Simla\Model\Response\GetOrderListResponse $response */
$response = $client->sendRequest(new GetOrderListRequest());
```
Each request uses provided `jwt` **token** for authorization.

**Friendly note.** Use response type annotations. Both client methods which returns responses actually returns `ResponseInterface` (not the PSR one). Actual response type will be determined by the request model. Your IDE will not recognize any response options unless you put a proper type annotation for the response variable.

## Customization
This library uses Container pattern under the hood. You can pass additional dependencies using `ContainerBuilder`. For example:
```php
use Http\Client\Curl\Client;
use Simla\Component\AppData;
use Simla\Component\Environment;
use Nyholm\Psr7\Factory\Psr17Factory;
use Simla\Builder\ClientBuilder;
use Simla\Builder\ContainerBuilder;
use Simla\Component\Logger\StdoutLogger;

$client = new Client();
$logger = new StdoutLogger();
$factory = new Psr17Factory();
$appData = new AppData(AppData::ENDPOINT, 'jwt token');
$container = ContainerBuilder::create()
            ->setEnv(Environment::TEST)
            ->setClient($client)
            ->setLogger($logger)
            ->setStreamFactory($factory)
            ->setRequestFactory($factory)
            ->setUriFactory($factory)
            ->build();
$client = ClientBuilder::create()
            ->setContainer($container)
            ->setAppData($appData)
            ->build();
```
Logger should implement `Psr\Log\LoggerInterface` (PSR-3), HTTP client should implement `Psr\Http\TopClient\TopClientInterface` (PSR-18), HTTP objects must be compliant to PSR-7.
You can use your own container if you want to - it must be compliant to PSR-11. This is strongly discouraged because it'll be much easier to just integrate library with your own application, and your own DI system.

The simplest example of client initialization without using `ClientFactory` looks like this:
```php
use Simla\Component\AppData;
use Simla\Builder\ClientBuilder;
use Simla\Builder\ContainerBuilder;

$appData = new AppData(AppData::ENDPOINT, 'jwt token');
$client = ClientBuilder::create()
            ->setContainer(ContainerBuilder::create()->build())
            ->setAppData($appData)
            ->build();
```
In fact, `ClientFactory` works just like this under the hood.

