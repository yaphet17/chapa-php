# Chapa-PHP

[![BUILD](https://github.com/yaphet17/chapa-php/actions/workflows/php.yml/badge.svg)](https://github.com/yaphet17/chapa-php/actions/workflows/php.yml/) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) 

Unoffial PHP library for for Chapa Payment Gateway.

## Descirption
Integrating Chapa to your app is simple as it is. So what benefit can you get from using this library? well, here are some of the benefits you can get by using 
this library.
   - Allows you to focus on building your app instead of spending time on making the integration to work.
   - It provides utility methods that can save you from writing some lines of codes. For example the library supports data validation out of the box, 
     so that you don't have to manually sanitize users input.
   - The library gives you an easy interface to manage any data send to or recieved from [Chapa API](https://developer.chapa.co/) in an object oriented 
     approach. 
   
## Documentation
Visit official [Chapa's API Documentation](https://developer.chapa.co/docs)

## Installation
Go to your project directory and install latest version of the library using following command
 ```php
 composer require yaphet17/chapa
```

## Usage

Instantiate a `Chapa` class.
```php
$chapa = new Chapa('{your-secrete-key}');
```
Create a `PostData` object that will represent your payment details.`PostData` class uses the [Fluent Interface](https://martinfowler.com/bliki/FluentInterface.html) 
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
identifies a specific transaction.
```php
$response2 = $chapa->verify(transactionRef);
```
Both of the above two methods (i.e `initialize` and `verify`) returns an instance of `ReponseData` class. This class will allow you to access the data 
returned by Chapa API with an OOP approach. It has an exact same structure as the JSON data returned by Chapa API.
```php
$statusCode = $resopnse1->getStatusCode();
$message = $response1->getMessage();
$success = $response1->getStatus();
$checkoutUrl = $response1->getData()->checkout_url;
```
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
            'customization[title]' => 'I love e-commerce',
            'customization[description]' => 'It is time to pay'
        )
    );

$response1 = $chapa->initialize($postData);

echo 'message ' . $response1->getMessage();
echo 'success ' . $response1->getStatus();
echo 'checkout url' . $response1->getData()->checkout_url;

$response2 = $chapa->verify($transactionRef);
if($response2->getStatusCode == 200){
   echo 'Payment not verified because ' . $response2->getMessage();
}
```
## Contribution

Any sort of contribution to this library is appreciated. Make a PR for minor changes or create an issue for breaking changes.




This open source library is licensed under the terms of the MIT License.

Enjoy.