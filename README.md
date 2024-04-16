# Jialian Payment's account allocation business PHP SDK.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cooper/jlpay-allocate.svg?style=flat-square)](https://packagist.org/packages/cooper/jlpay-allocate)
[![Tests](https://img.shields.io/github/actions/workflow/status/myxiaoao/jlpay-allocate/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/myxiaoao/jlpay-allocate/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/cooper/jlpay-allocate.svg?style=flat-square)](https://packagist.org/packages/cooper/jlpay-allocate)

## Installation

You can install the package via composer:

```bash
composer require cooper/jlpay-allocate
```

## Usage

```php
$client = new Cooper\JlpayAllocate\Api('8f191de3d3f7acd064fb896f0c231654813f995d94a69421aed693920b63abadcb21152049adfb4ef35c43e9216f4ad402e2b429b0e42cf959bf66271c18e629', '5c1e714fb3828ceb5fec2af8475e254b3bbdda542a660f0238293228f13612f3', '50720711');
$response = $client->sendLedgerQueryRequest(mchId: '849584358120018', orderNo: '61106708379852213248');;
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Cooper](https://github.com/myxiaoao)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
