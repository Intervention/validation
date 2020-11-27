# Intervention Validation

Intervention Validation is an extension library for Laravel's own validation system. The package adds rules to validate data like IBAN, BIC, ISBN, creditcard numbers and more.

[![Latest Version](https://img.shields.io/packagist/v/intervention/validation.svg)](https://packagist.org/packages/intervention/validation)
![build](https://github.com/Intervention/validation/workflows/build/badge.svg)
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
use Intervention\Validation\Exception\ValidationException;

// create validator (for HexColor)
$validator = new Validator(new HexColor);

// validate against given values
$valid = $validator->validate('#ccc'); // true
$valid = $validator->validate('www'); // false

// change the validation rule
$validator->setRule(new Domainname);

// now validate new rule domainname
$valid = $validator->validate('foo.com'); // true
$valid = $validator->validate('?'); // false

// validator can also throw exceptions on invalid data. 
// just call assert() instead of validate().
try {
    $validator->assert('foobar');
} catch (ValidationException $e) {
    echo $e->getMessage();
}
```

## Static Usage

```php
use Intervention\Validation\Validator;
use Intervention\Validation\Rules\HexColor;
use Intervention\Validation\Exception\ValidationException;

// create validator statically
$valid = Validator::make(new HexColor)->validate('ccc'); // true
$valid = Validator::make(new HexColor)->validate('#www'); // false

// throw exceptions on invalid data instead of returning boolean
try {
    Validator::make(new HexColor)->assert('www');
} catch (ValidationException $e) {
    echo $e->getMessage();
}
```

## Static dynamic call Usage

```php
use Intervention\Validation\Validator;
use Intervention\Validation\Rules\HexColor;
use Intervention\Validation\Exception\ValidationException;

// call validation rule directly via static method
$valid = Validator::isHexColor('#ccc'); // true
$valid = Validator::isHexColor('#www'); // false

// throw exceptions on invalid data
try {
    Validator::assertHexColor('foo');
} catch (ValidationException $e) {
    echo $e->getMessage();
}
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

```php
// example
'iban' => 'Please enter IBAN number!',
```

Or add your custom messages directly to the validator like [described in the docs](https://laravel.com/docs/6.x/validation#custom-error-messages).

## Available Rules

The following validation rules are available.

### base64 (Intervention\Validation\Rules\Base64)

Checks if given value is [Base64 encoded](https://en.wikipedia.org/wiki/Base64).

### bic (Intervention\Validation\Rules\Bic)

Checks for a valid [Business Identifier Code](https://en.wikipedia.org/wiki/ISO_9362) (BIC).

### camelcase (Intervention\Validation\Rules\CamelCase)

The given field must be a formated in [Camel case](https://en.wikipedia.org/wiki/Camel_case).

### cidr (Intervention\Validation\Rules\Cidr)

Check if the value is a [Classless Inter-Domain Routing](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) notation (CIDR).

### creditcard (Intervention\Validation\Rules\Creditcard)

The given field must be a valid [creditcard number](https://en.wikipedia.org/wiki/Payment_card_number).

### domainname (Intervention\Validation\Rules\Domainname)

The given field must be a well formed [domainname](https://en.wikipedia.org/wiki/Domain_name).

### hexcolor (Intervention\Validation\Rules\HexColor)

The field under validation must be a valid [hexadecimal color code](https://en.wikipedia.org/wiki/Web_colors).

### htmlclean (Intervention\Validation\Rules\HtmlClean)

The field under validation must be free of any html code.

### iban (Intervention\Validation\Rules\Iban)

Checks for a valid [International Bank Account Number](https://en.wikipedia.org/wiki/International_Bank_Account_Number) (IBAN).

### imei (Intervention\Validation\Rules\Imei)

The given field must be a [International Mobile Equipment Identity](https://en.wikipedia.org/wiki/International_Mobile_Equipment_Identity) (IMEI).

### isbn (Intervention\Validation\Rules\Isbn)

The field under validation must be a valid [International Standard Book Number](https://en.wikipedia.org/wiki/International_Standard_Book_Number) (ISBN).

### isin (Intervention\Validation\Rules\Isin)

Checks for a valid [International Securities Identification Number](https://en.wikipedia.org/wiki/International_Securities_Identification_Number) (ISIN).

### issn (Intervention\Validation\Rules\Issn)

Checks for a valid [International Standard Serial Number](https://en.wikipedia.org/wiki/International_Standard_Serial_Number) (ISSN).

### jwt (Intervention\Validation\Rules\Jwt)

The given value must be a in format of a [JSON Web Token](https://en.wikipedia.org/wiki/JSON_Web_Token).

### kebabcase (Intervention\Validation\Rules\KebabCase)

The given value must be formated in [Kebab case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles).

### lowercase (Intervention\Validation\Rules\LowerCase)

The given value must be all lower case letters.

### luhn (Intervention\Validation\Rules\Luhn)

The given value must verify against its included [Luhn algorithm](https://en.wikipedia.org/wiki/Luhn_algorithm) check digit.

### macaddress (Intervention\Validation\Rules\MacAddress)

The field under validation must be a [media access control address](https://en.wikipedia.org/wiki/MAC_address) (MAC address).

### semver (Intervention\Validation\Rules\SemVer)

The given field must be a valid version numbers using [Semantic Versioning](https://semver.org/).

### slug (Intervention\Validation\Rules\Slug)

The field under validation must be a user- and [SEO-friendly short text](https://en.wikipedia.org/wiki/Clean_URL#Slug).

### snakecase (Intervention\Validation\Rules\SnakeCase)

The field under validation must formated as [Snake case](https://en.wikipedia.org/wiki/Snake_case) text.

### titlecase (Intervention\Validation\Rules\TitleCase)

The field under validation must formated in [Title case](https://en.wikipedia.org/wiki/Title_case).

### uppercase (Intervention\Validation\Rules\UpperCase)

The field under validation must be all upper case.

### username (Intervention\Validation\Rules\Username)

The field under validation must be a valid username with a minimum of 3 characters and maximum of 20 characters. Consisting of alpha-numeric characters, underscores, minus and starting with a alphabetic character. Multiple underscore and minus chars are not allowed. Underscore and minus chars are not allowed at the beginning or end.


## License

Intervention Validation is licensed under the [MIT License](http://opensource.org/licenses/MIT).
