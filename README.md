# Intervention Validation Class

Extension for the Laravel 4 validation class

## Installation

You can install this package quick and easy with Composer.

Require the package via Composer in your `composer.json`.

    "intervention/validation": "dev-master"

Run Composer to update the new requirement.

    $ composer update

The Validation class is built to work with the Laravel 4 Framework. The integration is done in seconds.

Open your Laravel config file `config/app.php` and change the service provider for validation in the `$providers` array from the original validation provider `'Illuminate\Validation\ValidationServiceProvider'` to the following:
    
    'providers' => array(

        ...

        'Intervention\Validation\ValidationServiceProvider'

    ),
  

## Available Validation Rules for Laravel 4

The installed package provides the following additional validation rules including error messages.

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