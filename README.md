# Intervention Validation

Intervention Validation is an extension library for Laravel's own validation system. The package adds rules to validate data like IBAN, BIC, ISBN, creditcard numbers and more.

[![Latest Version](https://img.shields.io/packagist/v/intervention/validation.svg)](https://packagist.org/packages/intervention/validation)
[![Build Status](https://travis-ci.org/Intervention/validation.png?branch=master)](https://travis-ci.org/Intervention/validation)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/validation.svg)](https://packagist.org/packages/intervention/validation/stats)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/validation

### Laravel integration (optional)

The Validation library is built to work with the Laravel Framework (>=5.5). It comes with a service provider, which will be discovered automatically and registers the validation rules into your installation.

## Usage

```php
use Intervention\Validation\Validator;
use Intervention\Validation\Rules\HexColor;

// create validator (for HexColor)
$validator = new Validator(new HexColor);

// validate against given values
$valid = $validator->validate('#ccc'); // true
$valid = $validator->validate('www'); // false

// change the validation rule
$validator->setRule(new Domainname);

// validate other rules
$valid = $validator->validate('foo.com'); // true
$valid = $validator->validate('?'); // false
```

## Static Usage

```php
use Intervention\Validation\Validator;
use Intervention\Validation\Rules\HexColor;

// create validator statically
$valid = Validator::make(new HexColor)->validate('ccc') // true
$valid = Validator::make(new HexColor)->validate('#www') // false
```

## Static dynamic call Usage

```php
use Intervention\Validation\Validator;
use Intervention\Validation\Rules\HexColor;

// call validation rule directly via static method
$valid = Validator::isHexColor('#ccc') // true
$valid = Validator::isHexColor('#www') // false
```

## Usage with Laravel

The installed package provides additional `validation rules` including their error messages.

```php
use Illuminate\Support\Facades\Validator;

$validator = Validator::make($request->all(), [
    'color' => 'required|hexcolor',
    'number' => 'iban',
]);
```

### Changing the error messages:

Add the corresponding key to `/resources/lang/<language>/validation.php` like this:

```
// example
'iban' => 'Please enter IBAN number!',
```

Or add your custom messages directly to the validator like [described in the docs](https://laravel.com/docs/6.x/validation#custom-error-messages).

## Available Rules

The following validation rules are available.

### bic (Intervention\Validation\Rules\Bic)

Checks for a valid Business Identifier Code (BIC).

### iban (Intervention\Validation\Rules\Iban)

Checks for a valid International Bank Account Number (IBAN).

### isin (Intervention\Validation\Rules\Isin)

Checks for a valid International Securities Identification Number (ISIN).

### creditcard (Intervention\Validation\Rules\Creditcard)

The given field must be a valid creditcard number.

### hexcolor (Intervention\Validation\Rules\HexColor)

The field under validation must be a valid hexadecimal color code.

### isbn (Intervention\Validation\Rules\Isbn)

The field under validation must be a valid International Standard Book Number (ISBN).

### username (Intervention\Validation\Rules\Username)

The field under validation must be a valid username with a minimum of 3 characters and maximum of 20 characters. Consisting of alpha-numeric characters, underscores, minus and starting with a alphabetic character. 

### htmlclean (Intervention\Validation\Rules\HtmlClean)

The field under validation must be free of any html code.

### domainname (Intervention\Validation\Rules\Domainname)

The given field must be a well formed domainname.

### imei (Intervention\Validation\Rules\Imei)

The given field must be a International Mobile Equipment Identity (IMEI).

### macaddress (Intervention\Validation\Rules\MacAddress)

The field under validation must be a media access control address (MAC address).

## License

Intervention Validation Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
