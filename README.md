# Intervention Validation Class

Extension for the Laravel validation class

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer:

    $ composer require intervention/validation

The Validation class is built to work with the Laravel Framework. The integration is done in seconds.

Open your Laravel config file `config/app.php` and add service provider in the `$providers` array:
    
    'providers' => array(

        ...

        'Intervention\Validation\ValidationServiceProvider'

    ),
  

## Usage with Laravel

The installed package provides the following additional `validation rules` including their error messages.

### bic

Checks for a valid Business Identifier Code (BIC).

### iban

Checks for a valid International Bank Account Number (IBAN).

### creditcard

The given field must be a valid creditcard number.

### hexcolor

The field under validation must be a valid hexadecimal color code.

### isbn

The field under validation must be a valid International Standard Book Number (ISBN).

### isodate

The field under validation must be a valid date in ISO 8601 format.

### username

The field under validation must be a valid username with a minimum of 3 characters and maximum of 20 characters. Consisting of alpha-numeric characters, underscores and starting with a alphabetic character. 

### htmlclean

The field under validation must be free of any html code.

### password

Checks for valid password with a minimum of 6 characters and maximum of 64 characters, containing at least one digit, one upper case letter, one lower case letter and one special symbol.

## Changing the error messages:

Add the corresponding key to `/resources/lang/<language>/validation.php` like this:

```
// example
'iban' => 'Please enter IBAN number!',
```

Or add your custom messages directly to the validator like [described in the docs](http://laravel.com/docs/5.1/validation#custom-error-messages).

## Usage outside of Laravel

* Validator::isIban - Checks if given value is valid International Bank Account Number (IBAN).
* Validator::isBic - Checks if given value is valid Bank Identifier Code (BIC).
* Validator::isHexcolor - Checks if value is valid hexadecimal color code.
* Validator::isCreditcard - Checks if value is valid creditcard number.
* Validator::isIsbn - Checks if given value is valid International Standard Book Number (ISBN).
* Validator::isIsodate - Checks if given value is date in ISO 8601 format.
* Validator::isUsername - Checks if given value is a valid username.
* Validator::isHtmlclean - Checks if given value contains html free content.
* Validator::isPassword - Checks if the given value contains 6 to 64 characters, including at least one digit, one upper case letter, one lower case letter and one special symbol.

## License

Intervention Validation Class is licensed under the [MIT License](http://opensource.org/licenses/MIT).
