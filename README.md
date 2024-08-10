# Intervention Validation

Intervention Validation is an extension library for Laravel's own validation
system. The package adds rules to validate data like IBAN, BIC, ISBN,
creditcard numbers and more.

[![Latest Version](https://img.shields.io/packagist/v/intervention/validation.svg)](https://packagist.org/packages/intervention/validation)
[![Tests](https://github.com/Intervention/validation/actions/workflows/build.yml/badge.svg)](https://github.com/Intervention/validation/actions/workflows/build.yml)
[![Monthly Downloads](https://img.shields.io/packagist/dm/intervention/validation.svg)](https://packagist.org/packages/intervention/validation/stats)
[![Support me on Ko-fi](https://raw.githubusercontent.com/Intervention/validation/main/.github/images/support.svg)](https://ko-fi.com/interventionphp)

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/validation

## Laravel integration

The Validation library is built to work with the Laravel Framework (>=10). It
comes with a service provider, which will be discovered automatically and
registers the validation rules into your installation. The package provides 30
additional validation rules including multi language error messages, which can
be used like Laravel's own validation rules.

```php
use Illuminate\Support\Facades\Validator;
use Intervention\Validation\Rules\Creditcard;
use Intervention\Validation\Rules\Hexadecimalcolor;
use Intervention\Validation\Rules\Username;

$validator = Validator::make($request->all(), [
    'color' => new Hexadecimalcolor([3, 6]), // pass rule as object
    'number' => ['required', 'creditcard'], // or pass rule as string
    'name' => 'required|min:3|max:20|username', // combining rules works as well
]);
```

### Changing the error messages:

Add the corresponding key to `/resources/lang/<language>/validation.php` like this:

```php
// example
'iban' => 'Please enter IBAN number!',
```
Or add your custom messages directly to the validator like [described in the docs](https://laravel.com/docs/10.x/validation#manual-customizing-the-error-messages).

## Available Rules

The following validation rules are available with this package.

### Austrian insurance Number (austrian social security number)

The field under validation must be an [Austrian insurance number](https://de.wikipedia.org/wiki/Sozialversicherungsnummer#%C3%96sterreich)

    public Intervention\Validation\Rules\AustrianInsuranceNumber::__construct()

### Base64 encoded string

The field under validation must be [Base64 encoded](https://en.wikipedia.org/wiki/Base64).

    public Intervention\Validation\Rules\Base64::__construct()

### Business Identifier Code (BIC)

Checks for a valid [Business Identifier Code](https://en.wikipedia.org/wiki/ISO_9362) (BIC).

    public Intervention\Validation\Rules\Bic::__construct()

### Camel case string

The field under validation must be a formatted in [Camel case](https://en.wikipedia.org/wiki/Camel_case).

    public Intervention\Validation\Rules\Camelcase::__construct()

### Classless Inter-Domain Routing (CIDR)

Check if the value is a [Classless Inter-Domain Routing](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) notation (CIDR).

    public Intervention\Validation\Rules\Cidr::__construct()

### Creditcard Number

The field under validation must be a valid [creditcard number](https://en.wikipedia.org/wiki/Payment_card_number).

    public Intervention\Validation\Rules\Creditcard::__construct()

### Data URI scheme

The field under validation must be a valid [Data URI](https://en.wikipedia.org/wiki/Data_URI_scheme).

    public Intervention\Validation\Rules\DataUri::__construct(?array $media_types = null)

### Domain name

The field under validation must be a well formed [domainname](https://en.wikipedia.org/wiki/Domain_name).

    public Intervention\Validation\Rules\Domainname::__construct()

### European Article Number (EAN)

Checks for a valid [European Article Number](https://en.wikipedia.org/wiki/International_Article_Number).

    public Intervention\Validation\Rules\Ean::__construct(array $lengths = [8, 13])

#### Parameters

**length**

Optional integer length (8 or 13) to check only for EAN-8 or EAN-13.

### Global Release Identifier (GRid)

The field under validation must be a [Global Release Identifier](https://en.wikipedia.org/wiki/Global_Release_Identifier).

    public Intervention\Validation\Rules\Grid::__construct()

### Global Trade Item Number (GTIN)

Checks for a valid [Global Trade Item Number](https://en.wikipedia.org/wiki/Global_Trade_Item_Number).

    public Intervention\Validation\Rules\Gtin::__construct(array $lengths = [8, 12, 13, 14])

#### Parameters

**length**

Optional array of allowed lengths to check only for certain types (GTIN-8, GTIN-12, GTIN-13 or GTIN-14).

### Hexadecimal color code

The field under validation must be a valid [hexadecimal color code](https://en.wikipedia.org/wiki/Web_colors).

    public Intervention\Validation\Rules\Hexadecimalcolor::__construct(array $lengths = [3, 4, 6, 8])

#### Parameters

**length**

Optional length as integer to check only for shorthand (3 or 4 characters) or full hexadecimal (6 or 8 characters) form.

### HSL Color

The field under validation must be a valid [HSL color code](https://en.wikipedia.org/wiki/HSL_and_HSV).

    public Intervention\Validation\Rules\Hslcolor::__construct()

### HSV Color

The field under validation must be a valid [HSV/HSB color code](https://en.wikipedia.org/wiki/HSL_and_HSV).

    public Intervention\Validation\Rules\Hsvcolor::__construct()

### Text without HTML

The field under validation must be free of any html code.

    public Intervention\Validation\Rules\HtmlClean::__construct()

### International Bank Account Number (IBAN)

Checks for a valid [International Bank Account Number](https://en.wikipedia.org/wiki/International_Bank_Account_Number) (IBAN).

    public Intervention\Validation\Rules\Iban::__construct()

### International Mobile Equipment Identity (IMEI)

The field under validation must be a [International Mobile Equipment Identity](https://en.wikipedia.org/wiki/International_Mobile_Equipment_Identity) (IMEI).

    public Intervention\Validation\Rules\Imei::__construct()

### International Standard Book Number (ISBN)

The field under validation must be a valid [International Standard Book Number](https://en.wikipedia.org/wiki/International_Standard_Book_Number) (ISBN).

    public Intervention\Validation\Rules\Isbn::__construct(array $lengths = [10, 13])

#### Parameters

**length**

Optional length parameter as integer to check only for ISBN-10 or ISBN-13.

### International Securities Identification Number (ISIN)

Checks for a valid [International Securities Identification Number](https://en.wikipedia.org/wiki/International_Securities_Identification_Number) (ISIN).

    public Intervention\Validation\Rules\Isin::__construct()

### International Standard Serial Number (ISSN)

Checks for a valid [International Standard Serial Number](https://en.wikipedia.org/wiki/International_Standard_Serial_Number) (ISSN).

    public Intervention\Validation\Rules\Issn::__construct()

### JSON Web Token (JWT)

The given value must be a in format of a [JSON Web Token](https://en.wikipedia.org/wiki/JSON_Web_Token).

    public Intervention\Validation\Rules\Jwt::__construct()

### Kebab case string

The given value must be formatted in [Kebab case](https://en.wikipedia.org/wiki/Letter_case#Special_case_styles).

    public Intervention\Validation\Rules\Kebabcase::__construct()

### Latitude

Checks for a valid geographic [Latitude](https://en.wikipedia.org/wiki/Latitude).

    public Intervention\Validation\Rules\Latitude::__construct()

### Longitude

Checks for a valid geographic [Longitude](https://en.wikipedia.org/wiki/Longitude).

    public Intervention\Validation\Rules\Longitude::__construct()

### LatLng

Checks for a valid geographic comma separated pair of a [Latitude](https://en.wikipedia.org/wiki/Latitude) and a [Longitude](https://en.wikipedia.org/wiki/Longitude).

    public Intervention\Validation\Rules\LatLng::__construct()

### Lower case string

The given value must be all lower case letters.

    public Intervention\Validation\Rules\Lowercase::__construct()

### Luhn algorithm

The given value must verify against its included [Luhn algorithm](https://en.wikipedia.org/wiki/Luhn_algorithm) check digit.

    public Intervention\Validation\Rules\Luhn::__construct()

### Media (MIME) type

Checks for a valid [Mime Type](https://en.wikipedia.org/wiki/Media_type) (Media type).

    public Intervention\Validation\Rules\MimeType::__construct()

### Postal Code

The field under validation must be a [postal code](https://en.wikipedia.org/wiki/Postal_code) of the given country.

    public Intervention\Validation\Rules\Postalcode::__construct(array $countrycodes = [])

#### Parameters

**countrycode**

Country code in [ISO-639-1](https://en.wikipedia.org/wiki/ISO_639-1) format.

### Postal Code (static instantiation)

    public static Intervention\Validation\Rules\Postalcode::countrycode(array $countrycodes): Postalcode

#### Parameters

**countrycode**

Country code in [ISO-639-1](https://en.wikipedia.org/wiki/ISO_639-1) format.

### Postal Code (static instantiation with reference)

    public static Intervention\Validation\Rules\Postalcode::reference(string $reference): Postalcode

#### Parameters

**reference**

Reference key to get [ISO-639-1](https://en.wikipedia.org/wiki/ISO_639-1) country code from other data in validator.

### Semantic Version Number

The field under validation must be a valid version numbers using [Semantic Versioning](https://semver.org/).

    public Intervention\Validation\Rules\SemVer::__construct()

### SEO-friendly short text (Slug)

The field under validation must be a user- and [SEO-friendly short text](https://en.wikipedia.org/wiki/Clean_URL#Slug).

    public Intervention\Validation\Rules\Slug::__construct()

### Snake case string

The field under validation must formatted as [Snake case](https://en.wikipedia.org/wiki/Snake_case) text.

    public Intervention\Validation\Rules\Snakecase::__construct()

### Title case string

The field under validation must formatted in [Title case](https://en.wikipedia.org/wiki/Title_case).

    public Intervention\Validation\Rules\Titlecase::__construct()

### Universally Unique Lexicographically Sortable Identifier (ULID)

The field under validation must be a valid [Universally Unique Lexicographically Sortable Identifier](https://github.com/ulid/spec).

    public Intervention\Validation\Rules\Ulid::__construct()

### Upper case string

The field under validation must be all upper case.

    public Intervention\Validation\Rules\Uppercase::__construct()

### Username

The field under validation must be a valid username. Consisting of
alpha-numeric characters, underscores, minus and starting with a alphabetic
character. Multiple underscore and minus chars are not allowed. Underscore and
minus chars are not allowed at the beginning or end.

    public Intervention\Validation\Rules\Username::__construct()

## Development & Testing

With this package comes a Docker image to build a test suite container. To
build this container you have to have Docker installed on your system. You can
run all tests with this command.

    $ docker-compose run --rm --build tests

## Authors

This library is developed and maintained by [Oliver Vogel](https://intervention.io)

Thanks to the community of [contributors](https://github.com/Intervention/validation/graphs/contributors) who have helped to improve this project.

## License

Intervention Validation is licensed under the [MIT License](LICENSE).
