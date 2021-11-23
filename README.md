# wefact-api-client

Easy WeFact API client

## Requirements

This package requires at least PHP 7.4 and uses Guzzle.

## Installation

This package can be used in any PHP project or with any framework.

You can install the package via composer:

`composer require vdhicts/wefact-api-client`

## Usage

This package is just an easy client for using the WeFact API. Please refer to the
[API documentation](https://www.wefact.nl/api/) for more information about the requests.

### Getting started

```php
// Initialize the client
$client = new \Vdhicts\WeFact\WeFactClient($apiKey);

// Prepare the request
$request = new \Vdhicts\WeFact\WeFactRequest('creditor', 'list');

// Perform the request
$response = $client->perform($request);

if ($response->isSuccess()) {
    $response->getData('creditors');
}
```

Or if you need to provide extra parameters (i.e. for a 'add' request):

```php
$request = new \Vdhicts\WeFact\WeFactRequest('creditor', 'add', [
    'CompanyName' => 'Vdhicts',
]);
```

The `getData` method is able to use the dot notation. For example:

```php
$request = new \Vdhicts\WeFact\WeFactRequest('creditor', 'show', ['CreditorCode' => 'CD50000']);
$response = $client->perform($request);
..
$response->getData('creditor.CompanyName');
```

### Handling errors

When an error occurs, a `WeFactResponse` object is still returned. The error might be provided by WeFact or from the 
client but will always be available in the data with the `errors` key.

```php
$request = new \Vdhicts\WeFact\WeFactRequest('creditor', 'lol');
$response = $client->perform($request);

if (!$response->isSuccess()) {
    var_dump($response->getData('errors'));
}
```

Will show:

```
array(1) {
    [0]=>
        string(14) "Invalid action"
    }
}
```

## Tests

Unit tests are available in the `tests` folder. Run with:

`composer test`

When you want a code coverage report which will be generated in the `build/report` folder. Run with:

`composer test-coverage`

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
