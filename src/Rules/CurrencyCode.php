<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;
use InvalidArgumentException;

class CurrencyCode extends AbstractRule
{
    public const ALPHA = 'alpha';
    public const NUMERIC = 'numeric';

    private const VALUES = [
        self::ALPHA => [
            'AFN', 'EUR', 'ALL', 'DZD', 'USD', 'EUR', 'AOA', 'XCD', 'XCD', 'XAD', 'ARS', 'AMD', 'AWG', 'AUD', 'EUR',
            'AZN', 'BSD', 'BHD', 'BDT', 'BBD', 'BYN', 'EUR', 'BZD', 'XOF', 'BMD', 'INR', 'BTN', 'BOB', 'BOV', 'USD',
            'BAM', 'BWP', 'NOK', 'BRL', 'USD', 'BND', 'EUR', 'XOF', 'BIF', 'CVE', 'KHR', 'XAF', 'CAD', 'KYD', 'XAF',
            'XAF', 'CLP', 'CLF', 'CNY', 'AUD', 'AUD', 'COP', 'COU', 'KMF', 'CDF', 'XAF', 'NZD', 'CRC', 'XOF', 'EUR',
            'CUP', 'XCG', 'EUR', 'CZK', 'DKK', 'DJF', 'XCD', 'DOP', 'USD', 'EGP', 'SVC', 'USD', 'XAF', 'ERN', 'EUR',
            'SZL', 'ETB', 'EUR', 'FKP', 'DKK', 'FJD', 'EUR', 'EUR', 'EUR', 'XPF', 'EUR', 'XAF', 'GMD', 'GEL', 'EUR',
            'GHS', 'GIP', 'EUR', 'DKK', 'XCD', 'EUR', 'USD', 'GTQ', 'GBP', 'GNF', 'XOF', 'GYD', 'HTG', 'USD', 'AUD',
            'EUR', 'HNL', 'HKD', 'HUF', 'ISK', 'INR', 'IDR', 'XDR', 'IRR', 'IQD', 'EUR', 'GBP', 'ILS', 'EUR', 'JMD',
            'JPY', 'GBP', 'JOD', 'KZT', 'KES', 'AUD', 'KPW', 'KRW', 'KWD', 'KGS', 'LAK', 'EUR', 'LBP', 'LSL', 'ZAR',
            'LRD', 'LYD', 'CHF', 'EUR', 'EUR', 'MOP', 'MGA', 'MWK', 'MYR', 'MVR', 'XOF', 'EUR', 'USD', 'EUR', 'MRU',
            'MUR', 'EUR', 'XUA', 'MXN', 'MXV', 'USD', 'MDL', 'EUR', 'MNT', 'EUR', 'XCD', 'MAD', 'MZN', 'MMK', 'NAD',
            'ZAR', 'AUD', 'NPR', 'EUR', 'XPF', 'NZD', 'NIO', 'XOF', 'NGN', 'NZD', 'AUD', 'MKD', 'USD', 'NOK', 'OMR',
            'PKR', 'USD', 'PAB', 'USD', 'PGK', 'PYG', 'PEN', 'PHP', 'NZD', 'PLN', 'EUR', 'USD', 'QAR', 'EUR', 'RON',
            'RUB', 'RWF', 'EUR', 'SHP', 'XCD', 'XCD', 'EUR', 'EUR', 'XCD', 'WST', 'EUR', 'STN', 'SAR', 'XOF', 'RSD',
            'SCR', 'SLE', 'SGD', 'XCG', 'XSU', 'EUR', 'EUR', 'SBD', 'SOS', 'ZAR', 'SSP', 'EUR', 'LKR', 'SDG', 'SRD',
            'NOK', 'SEK', 'CHF', 'CHE', 'CHW', 'SYP', 'TWD', 'TJS', 'TZS', 'THB', 'USD', 'XOF', 'NZD', 'TOP', 'TTD',
            'TND', 'TRY', 'TMT', 'USD', 'AUD', 'UGX', 'UAH', 'AED', 'GBP', 'USD', 'USD', 'USN', 'UYU', 'UYI', 'UYW',
            'UZS', 'VUV', 'VES', 'VED', 'VND', 'USD', 'USD', 'XPF', 'MAD', 'YER', 'ZMW', 'ZWG', 'XBA', 'XBB', 'XBC',
            'XBD', 'XTS', 'XXX', 'XAU', 'XPD', 'XPT', 'XAG',
        ],
        self::NUMERIC => [
            '971', '978', '008', '012', '840', '978', '973', '951', '951', '396', '032', '051', '533', '036', '978',
            '944', '044', '048', '050', '052', '933', '978', '084', '952', '060', '356', '064', '068', '984', '840',
            '977', '072', '578', '986', '840', '096', '978', '952', '108', '132', '116', '950', '124', '136', '950',
            '950', '152', '990', '156', '036', '036', '170', '970', '174', '976', '950', '554', '188', '952', '978',
            '192', '532', '978', '203', '208', '262', '951', '214', '840', '818', '222', '840', '950', '232', '978',
            '748', '230', '978', '238', '208', '242', '978', '978', '978', '953', '978', '950', '270', '981', '978',
            '936', '292', '978', '208', '951', '978', '840', '320', '826', '324', '952', '328', '332', '840', '036',
            '978', '340', '344', '348', '352', '356', '360', '960', '364', '368', '978', '826', '376', '978', '388',
            '392', '826', '400', '398', '404', '036', '408', '410', '414', '417', '418', '978', '422', '426', '710',
            '430', '434', '756', '978', '978', '446', '969', '454', '458', '462', '952', '978', '840', '978', '929',
            '480', '978', '965', '484', '979', '840', '498', '978', '496', '978', '951', '504', '943', '104', '516',
            '710', '036', '524', '978', '953', '554', '558', '952', '566', '554', '036', '807', '840', '578', '512',
            '586', '840', '590', '840', '598', '600', '604', '608', '554', '985', '978', '840', '634', '978', '946',
            '643', '646', '978', '654', '951', '951', '978', '978', '951', '882', '978', '930', '682', '952', '941',
            '690', '925', '702', '532', '994', '978', '978', '090', '706', '710', '728', '978', '144', '938', '968',
            '578', '752', '756', '947', '948', '760', '901', '972', '834', '764', '840', '952', '554', '776', '780',
            '788', '949', '934', '840', '036', '800', '980', '784', '826', '840', '840', '997', '858', '940', '927',
            '860', '548', '928', '926', '704', '840', '840', '953', '504', '886', '967', '924', '955', '956', '957',
            '958', '963', '999', '959', '964', '962', '961',
        ],
    ];

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(protected string $format = self::ALPHA, protected bool $strict = true)
    {
        if (!in_array($this->format, [self::ALPHA, self::NUMERIC])) {
            throw new InvalidArgumentException('Invalid format.');
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $value = strval($value);

        if ($this->strict === false) {
            $value = strtoupper($value);
        }

        return in_array($value, self::VALUES[$this->format], strict: true);
    }
}
