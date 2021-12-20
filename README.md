# wefact-api-client

Easy WeFact API client

## Requirements

This package requires at least PHP 7.4.

## Installation

This package can be used in any PHP project or with any framework.

You can install the package via composer:

`composer require vdhicts/wefact-api-client`

## Usage

This package is just an easy client for using the WeFact API. Please refer to the
[API documentation](https://www.wefact.nl/api/) for more information about the requests.

### Getting started

```php
use Vdhicts\WeFact\WeFact;
use Vdhicts\WeFact\WeFactRequest;
use Vdhicts\WeFact\Enums\WeFactController;

// Initialize the client
$client = new WeFact($apiKey);

// Perform the request
$request = new WeFactRequest(WeFactController::CREDITOR, 'list');
$response = $client->request($request);

if ($response->ok()) {
    $response->json('creditors');
}
```

Or if you need to provide extra parameters (i.e. for a 'add' request):

```php
$request = new WeFactRequest(WeFactController::CREDITOR, 'add', [
    'CompanyName' => 'Vdhicts',
]);
$response = $client->request($request);
```

### Extending the client

You can extend the client and implement your own endpoints:

```php
use Vdhicts\WeFact\Enums\WeFactController;
use Vdhicts\WeFact\WeFact;
use Vdhicts\WeFact\WeFactRequest;

class Debtor extends WeFact 
{
    public function show(string $debtorCode): Response
    {
        $request = new WeFactRequest(WeFactController::DEBTOR, 'show', [
            'DebtorCode' => $debtorCode,
        ]);
    
        return $this->$request($request);
    }    
}
```

### Handling errors

A `Response` object will always be returned. See
[Error handling](https://laravel.com/docs/8.x/http-client#error-handling) of the Http Client.

```php
if ($response->failed()) {
    var_dump($response->serverError());
}
```

### Laravel

This package can be easily used in any Laravel application. I would suggest adding your credentials to the `.env` file
of the project:

```
WEFACT_API_KEY=apikey
```

Next create a config file `wefact.php` in `/config`:

```php
<?php

return [
    'api_key' => env('WEFACT_API_KEY'),
];
```

Then initialize the client with the API key:

```php
$client = new \Vdhicts\WeFact\WeFact(config('wefact.api_key'));
```

In the future I might make a Laravel specific package which uses this package.

## Contribution

Any contribution is welcome, but it should meet the PSR-12 standard and please create one pull request per feature/bug.
In exchange, you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email info@vdhicts.nl instead
of using the issue tracker.

## Support

This package isn't an official package from WeFact, so they probably won't offer support for it. If you encounter a
problem with this client or has a question about it, feel free to open an issue on GitHub.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## About Vdhicts

[Vdhicts](https://www.vdhicts.nl) is the name of my personal company for which I work as freelancer. Vdhicts develops
and implements IT solutions for businesses and educational institutions.
