# Osnova API SDK

[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]
[![ScrutinizerCI][ico-scrutinizer]][link-scrutinizer]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

## Requirements
This package requires PHP 7.0 or higher.

## Installation

You can install the package via composer:

``` bash
$ composer require tzurbaev/osnova-api
```

## Examples

### Get timeline entries

```php
<?php

use Osnova\TJournal;
use Osnova\Services\Timeline\Owners\TimelineCategory;

// Create resource instance with the "1.4" API version.
$tjournal = TJournal::make('1.4');

$entries = $tjournal->getTimelineEntries(new TimelineCategory('index'));
```

### Get entries from subsite

```php
<?php

use Osnova\TJournal;

$tjournal = TJournal::make('1.4');

$subsite = $tjournal->getSubsite(214352);
$entries = $tjournal->getTimelineEntries($subsite);
```

### Search for entries

```php
<?php

use Osnova\TJournal;
use Osnova\Services\Timeline\Owners\TimelineSearch;

$tjournal = TJournal::make('1.4');

$entries = $tjournal->getTimelineSearchResults('навальный');
// or
$entries = $tjournal->getTimelineEntries(new TimelineSearch('навальный'));
```

## Documentation

Full documentation is available [here](./docs/readme.md).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email zurbaev@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://poser.pugx.org/tzurbaev/osnova-api/version?format=flat
[ico-license]: https://poser.pugx.org/tzurbaev/osnova-api/license?format=flat
[ico-travis]: https://api.travis-ci.org/tzurbaev/osnova-api.svg?branch=master
[ico-styleci]: https://styleci.io/repos/160719620/shield?branch=master&style=flat
[ico-scrutinizer]: https://scrutinizer-ci.com/g/tzurbaev/osnova-api/badges/quality-score.png?b=master

[link-packagist]: https://packagist.org/packages/tzurbaev/osnova-api
[link-travis]: https://travis-ci.org/tzurbaev/osnova-api
[link-styleci]: https://styleci.io/repos/160719620
[link-scrutinizer]: https://scrutinizer-ci.com/g/tzurbaev/osnova-api/
[link-author]: https://github.com/tzurbaev
