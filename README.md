<p align="center"><img src="/404-monitor.png" alt="404 Monitor for Laravel Pulse"></p>

# Track 404 errors in Laravel Pulse

[![Latest Version on Packagist](https://img.shields.io/packagist/v/geowrgetudor/404-monitor.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/404-monitor)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/404-monitor/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/geowrgetudor/404-monitor/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/404-monitor/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/geowrgetudor/404-monitor/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/geowrgetudor/404-monitor.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/404-monitor)

This is a Laravel Pulse package that allows you to track 404 errors.

## Installation

You can install the package via composer:

```bash
composer require geowrgetudor/404-monitor
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="404-monitor-views"
```

## Usage

Register the recorder in `config/pulse.php`. (If you don\'t have this file make sure you have published the config file of Laravel Pulse using `php artisan vendor:publish --tag=pulse-config`)

```
return [
    // ...

    'recorders' => [
        // Existing recorders...

        \Geow\NotFoundMonitor\Recorders\NotFoundRecorder::class => [
            'enabled' => true,
            'ignore' => [
                // Ignore specific urls (regex supported)
            ],
        ]
    ]
]
```

Publish Laravel Pulse `dashboard.blade.php` view using `php artisan vendor:publish --tag=pulse-dashboard`

Then you can modify the file and add the 404-monitor livewire template.

```php
<livewire:404-monitor cols="full" />
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [George Tudor](https://github.com/geowrgetudor)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
