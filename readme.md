# HelpSpot PHP SDK

Web based help desk app your team will love to use. Manage email, provide self service and save
time. All securely on your own server or hosted for you.

## Installing

```sh
$ composer require "userscape/helpspot"
```

## Using

```php
$transport = new UserScape\HelpSpot\Transport("https://your-domain.helpspot.com");

$transport = $transport
    ->withEmail("your-email")
    ->withPassword("your-password");

$response = $transport->request("GET", "private.request.create", [
    "tNote"     => "A new request!",
    "xCategory" => ...
]);
```

```php
$client = new UserScape\HelpSpot\Client($transport);

$books = $client->request("kb.list");

// Array
// (
//     [0] => UserScape\HelpSpot\Object\BookObject Object
//         (
//             [name:protected]        => Working With The API
//             [order:protected]       => 0
//             [description:protected] => All you need to know about...
//             [id:protected]          => 1
//         )
// )

foreach ($books as $book) {
    print "book: " . $book->name() . "\n";
}
```

## Testing

```sh
$ git clone git@github.com:assertchris/helpspot-php-sdk.git
$ cd helpspot-php-sdk
$ vendor/bin/phpunit
```

## License

The MIT License (MIT)

Copyright (c) 2015 UserScape

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
associated documentation files (the "Software"), to deal in the Software without restriction,
including without limitation the rights to use, copy, modify, merge, publish, distribute,
sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or
substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT
OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
