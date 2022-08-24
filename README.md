# Chapa-PHP

[![BUILD](https://github.com/yaphet17/chapa-php/actions/workflows/php.yml/badge.svg)](https://github.com/yaphet17/chapa-php/actions/workflows/php.yml/)
[![Latest Stable Version](http://poser.pugx.org/yaphet17/chapa/v)](https://packagist.org/packages/yaphet17/chapa) [![Total Downloads](http://poser.pugx.org/yaphet17/chapa/downloads)](https://packagist.org/packages/yaphet17/chapa) [![Latest Unstable Version](http://poser.pugx.org/yaphet17/chapa/v/unstable)](https://packagist.org/packages/yaphet17/chapa) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Unofficial PHP library for Chapa Payment Gateway.

## Description
Integrating Chapa to your app is simple as it is. So what benefit can you get from using this library? well, here are some of the benefits you can get by using 
this library.
   - Allows you to focus on building your app instead of spending time on making the integration to work.
   - It provides utility methods that can save you from writing some lines of codes. For example the library supports data validation out of the box, 
     so that you don't have to manually sanitize users input.
   - The library gives you an easy interface to manage any data send to or received from [Chapa API](https://developer.chapa.co/) in an object-oriented 
     approach. 
   
## Documentation
Visit official [Chapa's API Documentation](https://developer.chapa.co/docs)

## Installation
Go to your project directory and install the latest version of the library using following command
 ```php
 composer require yaphet17/chapa
```

## Usage

Instantiate a `Chapa` class.
```php
$chapa = new Chapa('{your-secrete-key}');
```
Create a `PostData` object that will represent your payment details.`PostData` class uses the [Fluent Interface,](https://martinfowler.com/bliki/FluentInterface.html) 
so you can be able to chain setter methods.
```php
$postData = new PostData();
$postData->amount('100')
    ->currency('ETB')
    ->email('abebe@bikila.com')
    ->firstname('Abebe')
    ->lastname('Bikila')
    ->transactionRef('transaction-ref')
    ->callbackUrl('https://chapa.co')
    ->customizations(
        array(
            'customization[title]' => 'I love e-commerce',
            'customization[description]' => 'It is time to pay'
        ) 
    );
```
You can also use a utility method provided by the library to generate a unique and convenient transaction reference token. `Util` class provides a method
that can generate a token by combining your custom prefix such as company initials (optional), current timestamp and random string.
```php
$transactionRef = Util::generateToken('acme'); // generated transaction reference will start with the prefix aceme
```
To initialize a transaction, all you have to do is call `initializa` method in side `Chapa` class. Pass the `PostData` object you created in the above step.
```php
$response1 = $chapa->initialize($postData);
```
You can also verify your transaction using `verify` method inside `Chapa` class. This method takes a transaction reference token so that it can uniquely
identify a specific transaction.
```php
$response2 = $chapa->verify($transactionRef);
```
Both of the above two methods (i.e `initialize` and `verify`) returns an instance of `ReponseData` class. This class will allow you to access the data 
returned by Chapa API with an OOP approach. It has the same structure as the JSON data returned by Chapa API plus status code and a raw JSON data.
```php
$statusCode = $resopnse1->getStatusCode();
$message = $response1->getMessage();
$success = $response1->getStatus();
$data = $response1->getData();
```
For some reason, if you want the raw JSON data you can easily access it using `getRawJSON` method.
```php
$json = $response->getRawJson();
````
Below is the full implementation of the above steps.
```php
$chapa = new Chapa('{your-secrete-key}');
$transactionRef = Util::generateToken();
$postData = new PostData();
$postData->amount('100')
    ->currency('ETB')
    ->email('abebe@bikila.com')
    ->firstname('test')
    ->lastname('user')
    ->transactionRef($transactionRef)
    ->callbackUrl('https://chapa.co')
    ->customizations(
        array(
            'customization[title]' => 'E-commerce',
            'customization[description]' => 'It is time to pay'
        )
    );

$response1 = $chapa->initialize($postData);
print_r($response1->getMessage());
print_r($response1->getStatus());
print_r($response1->getData());
echo $response->getRawJson();
$response2 = $chapa->verify($transactionRef);
if($response2->getStatusCode() == 200){
    echo 'Payment not verified because ' . $response2->getMessage()['message'];
}
```
## Contribution

Any sort of contribution to this library is appreciated. Make a PR for minor changes or create an issue for breaking changes.




This open source library is licensed under the terms of the MIT License.

Enjoy.
