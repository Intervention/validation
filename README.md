# Intervention Validation

Intervention Validation is an extension library for Laravel's own validation system. The package adds rules to validate data like IBAN, BIC, ISBN, creditcard numbers and more.

[![Latest Version](https://img.shields.io/packagist/v/intervention/validation.svg)](https://packagist.org/packages/intervention/validation)
![build](https://github.com/Intervention/validation/workflows/build/badge.svg)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/validation.svg)](https://packagist.org/packages/intervention/validation/stats)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/validation

## Laravel integration

The Validation library is built to work with the Laravel Framework (>=7). It comes with a service provider, which will be discovered automatically and registers the validation rules into your installation. The package provides 30 additional validation rules including error messages.

**Make sure to pass any of the additional validation rules as objects and not as strings.** 

```php
use Illuminate\Support\Facades\Validator;
use Intervention\Validation\Rules\Creditcard;
use Intervention\Validation\Rules\HexColor;
use Intervention\Validation\Rules\Username;

$validator = Validator::make($request->all(), [
    'color' => new Hexcolor(3), // pass rule as object
    'name' => ['required', 'min:3', 'max:20', new Username()], // combining rules works as well
]);
```

### Changing the error messages:

Add the corresponding key to `/resources/lang/<language>/validation.php` like this:

```php
// example
'iban' => 'Please enter IBAN number!',
```
Or add your custom messages directly to the validator like [described in the docs](https://laravel.com/docs/8.x/validation#manual-customizing-the-error-messages).

## Available Rules

The following validation rules are available with this package.

## base64

The field under validation must be [Base64 encoded](https://en.wikipedia.org/wiki/Base64).

    public Intervention\Validation\Rules\Base64::__construct()

## bic

Checks for a valid [Business Identifier Code](https://en.wikipedia.org/wiki/ISO_9362) (BIC).

    public Intervention\Validation\Rules\Bic::__construct()

## camelcase

The field under validation must be a formated in [Camel case](https://en.wikipedia.org/wiki/Camel_case).

    public Intervention\Validation\Rules\CamelCase::__construct()

## cidr 

Check if the value is a [Classless Inter-Domain Routing](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) notation (CIDR).

    public Intervention\Validation\Rules\Cidr::__construct()

## creditcard 

The field under validation must be a valid [creditcard number](https://en.wikipedia.org/wiki/Payment_card_number).

    public Intervention\Validation\Rules\Creditcard::__construct()

## data url 

The field under validation must be a valid [data url](https://en.wikipedia.org/wiki/Data_URI_scheme).

    public Intervention\Validation\Rules\DataUrl::__construct()

## domainname 

The field under validation must be a well formed [domainname](https://en.wikipedia.org/wiki/Domain_name).

    public Intervention\Validation\Rules\Domainname::__construct()

## ean

Checks for a valid [European Article Number](https://en.wikipedia.org/wiki/International_Article_Number).

    public Intervention\Validation\Rules\Ean::__construct(?int $length = null)

### Parameters

**length**

Optional integer length (8 or 13) to check only for EAN-8 or EAN-13.

## gtin

Checks for a valid [Global Trade Item Number](https://en.wikipedia.org/wiki/Global_Trade_Item_Number).

    public Intervention\Validation\Rules\Gtin::__construct(?int $length = null)

### Parameters

**length**

Optional integer length to check only for certain types (GTIN-8, GTIN-12, GTIN-13 or GTIN-14).

## hexcolor

The field under validation must be a valid [hexadecimal color code](https://en.wikipedia.org/wiki/Web_colors). 

    public Intervention\Validation\Rules\HexColor::__construct(?int $length = null)

### Parameters

**length**

Optional length as integer to check only for shorthand (3 characters) or full hexadecimal (6 characters) form.

## htmlclean 

The field under validation must be free of any html code.

    public Intervention\Validation\Rules\HtmlClean::__construct()

## iban 

Checks for a valid [International Bank Account Number](https://en.wikipedia.org/wiki/International_Bank_Account_Number) (IBAN).

    public Intervention\Validation\Rules\Iban::__construct()

## imei 

The field under validation must be a [International Mobile Equipment Identity](https://en.wikipedia.org/wiki/International_Mobile_Equipment_Identity) (IMEI).

    public Intervention\Validation\Rules\Imei::__construct()

## isbn

The field under validation must be a valid [International Standard Book Number](https://en.wikipedia.org/wiki/International_Standard_Book_Number) (ISBN).

    public Intervention\Validation\Rules\Isbn::__construct(?int $length = null)

### Parameters

**length**

Optional length parameter as integer to check only for ISBN-10 or ISBN-13.

## isin 

Checks for a valid [International Securities Identification Number](https://en.wikipedia.org/wiki/International_Securities_Identification_Number) (ISIN).

    public Intervention\Validation\Rules\Isin::__construct()

## issn 

Checks for a valid [International Standard Serial Number](https://en.wikipedia.org/wiki/International_Standard_Serial_Number) (ISSN).

    public Intervention\Validation\Rules\Issn::__construct()

## jwt 

The given value must be a in format of a [JSON Web Token](https://en.wikipedia.org/wiki/JSON_Web_Token).

    public Intervention\Validation\Rules\Jwt::__construct()

## kebabcase 

The given value must be formated in [Kebab case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles).

    public Intervention\Validation\Rules\KebabCase::__construct()

## lowercase 

The given value must be all lower case letters.

    public Intervention\Validation\Rules\LowerCase::__construct()

## luhn 

The given value must verify against its included [Luhn algorithm](https://en.wikipedia.org/wiki/Luhn_algorithm) check digit.

    public Intervention\Validation\Rules\Luhn::__construct()

## macaddress 

The field under validation must be a [media access control address](https://en.wikipedia.org/wiki/MAC_address) (MAC address).

    public Intervention\Validation\Rules\MacAddress::__construct()

## mimetype 

Checks for a valid [Mime Type](https://en.wikipedia.org/wiki/Media_type) (Media type).

    public Intervention\Validation\Rules\MimeType::__construct()

## semver 

The field under validation must be a valid version numbers using [Semantic Versioning](https://semver.org/).

    public Intervention\Validation\Rules\SemVer::__construct()

## slug 

The field under validation must be a user- and [SEO-friendly short text](https://en.wikipedia.org/wiki/Clean_URL#Slug).

    public Intervention\Validation\Rules\Slug::__construct()

## snakecase 

The field under validation must formated as [Snake case](https://en.wikipedia.org/wiki/Snake_case) text.

    public Intervention\Validation\Rules\SnakeCase::__construct()

## titlecase 

The field under validation must formated in [Title case](https://en.wikipedia.org/wiki/Title_case).

    public Intervention\Validation\Rules\TitleCase::__construct()

## ulid 

The field under validation must be a valid [Universally Unique Lexicographically Sortable Identifier](https://github.com/ulid/spec).

    public Intervention\Validation\Rules\Ulid::__construct()

## uppercase 

The field under validation must be all upper case.

    public Intervention\Validation\Rules\UpperCase::__construct()

## username 

The field under validation must be a valid username. Consisting of alpha-numeric characters, underscores, minus and starting with a alphabetic character. Multiple underscore and minus chars are not allowed. Underscore and minus chars are not allowed at the beginning or end.

    public Intervention\Validation\Rules\Username::__construct()

## License

Intervention Validation is licensed under the [MIT License](http://opensource.org/licenses/MIT).
