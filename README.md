Useragent Detector Result
=========================

This library provides a set of classes representing a result of an useragent detection.

## Requirements

This library requires PHP 7.0+.
Also a PSR-3 compatible logger and a PSR-6 compatible cache are required.

## Installation

Run the command below to install via Composer

```shell
composer require mimmi20/ua-result
```

## The result object

The result object is the main object and contains only other objects.

## The browser object

The browser object represents the detected browser.

```php
// get the result by detection or create it

$browser = $result->getBrowser();

// get the name
$name = $browser->getName();

// get the manufaturer
$manCompany = $browser->getManufacturer()->getName();
$manBrand   = $browser->getManufacturer()->getBrandName();

// get the version
$name = $browser->getVersion()->getVersion();

// get the type
$type  = $browser->getType()->getName();
$isbot = $browser->getType()->isBot();
```

Note:
You should not rely on the `getRssSupport` and `getPdfSupport` functions. They may be removed in the future.

## The engine object

The engine object represents the detected rendering engine.

```php
// get the result by detection or create it

$engine = $result->getEngine();

// get the name
$name = $engine->getName();

// get the manufaturer
$manCompany = $engine->getManufacturer()->getName();
$manBrand   = $engine->getManufacturer()->getBrandName();

// get the version
$name = $engine->getVersion()->getVersion();
```

## The device object

The device object represents the detected device.

```php
// get the result by detection or create it

$device = $result->getDevice();

// get the (code) name
$name = $device->getDeviceName();
// the device may have a different marketing name
$mname = $device->getMarketingName();

// get the manufaturer
$manCompany = $device->getManufacturer()->getName();
$manBrand   = $device->getManufacturer()->getBrandName();
// the device may be a branded version
$brand = $device->getBrand()->getBrandName();

// get the amout of colors of the display
$colors = $device->getColors();

// does the device support dual orientation?
$dualorien = $device->getDualOrientation();

// get the pointing method
$pointing = $device->getPointingMethod();

// get the display dimensions
$height = $device->getResolutionHeight();
$width  = $device->getResolutionWidth();

// get some more information about the device type
$type     = $device->getType()->getName();
$isPhone  = $device->getType()->isPhone();
$isTablet = $device->getType()->isTablet();
```

Note:
You should not rely on the `getNfcSupport`, `getSmsSupport` and `getHasQwertyKeyboard` functions. They may be removed in the future.

## The platform object

The os object represents the detected platform.

```php
// get the result by detection or create it

$platform = $result->getOs();

// get the (code) name
$name  = $platform->getName();
// the platform may have a different marketing name
$mname = $platform->getMarketingName();

// get the manufaturer
$manCompany = $platform->getManufacturer()->getName();
$manBrand   = $platform->getManufacturer()->getBrandName();

// get the version
$name = $platform->getVersion()->getVersion();
```

## Project status

[![Latest Stable Version](https://poser.pugx.org/mimmi20/ua-result/v/stable)](https://packagist.org/packages/mimmi20/ua-result)
[![Latest Unstable Version](https://poser.pugx.org/mimmi20/ua-result/v/unstable)](https://packagist.org/packages/mimmi20/ua-result)
[![License](https://poser.pugx.org/mimmi20/ua-result/license)](https://packagist.org/packages/mimmi20/ua-result)

[![Build Status](https://api.travis-ci.org/mimmi20/ua-result.png?branch=master)](https://travis-ci.org/mimmi20/ua-result)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mimmi20/ua-result/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mimmi20/ua-result/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mimmi20/ua-result/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mimmi20/ua-result/?branch=master)

## Issues and feature requests

Please report your issues and ask for new features on the GitHub Issue Tracker
at https://github.com/mimmi20/ua-result/issues