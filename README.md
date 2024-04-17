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
$api = new Cooper\JlpayAllocate\Api(PUBLIC_KEY, PRIVATE_KEY, ORG_CODE);
$response = $api->sendOrderSplitQueryRequest(mchId: '849584358120018', orderNo: '61106708379852213248'); // 分账交易结果查询
var_dump($response);
```

> Check the API methods corresponding to the API class.

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
