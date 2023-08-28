# Useragent Detector Result

[![Latest Stable Version](https://poser.pugx.org/mimmi20/ua-result/v/stable?format=flat-square)](https://packagist.org/packages/mimmi20/ua-result)
[![Latest Unstable Version](https://poser.pugx.org/mimmi20/ua-result/v/unstable?format=flat-square)](https://packagist.org/packages/mimmi20/ua-result)
[![License](https://poser.pugx.org/mimmi20/ua-result/license?format=flat-square)](https://packagist.org/packages/mimmi20/ua-result)

## Code Status

[![codecov](https://codecov.io/gh/mimmi20/ua-result/branch/master/graph/badge.svg)](https://codecov.io/gh/mimmi20/ua-result)
[![Average time to resolve an issue](https://isitmaintained.com/badge/resolution/mimmi20/ua-result.svg)](https://isitmaintained.com/project/mimmi20/ua-result "Average time to resolve an issue")
[![Percentage of issues still open](https://isitmaintained.com/badge/open/mimmi20/ua-result.svg)](https://isitmaintained.com/project/mimmi20/ua-result "Percentage of issues still open")


## Description

This library provides a set of classes representing a result of an useragent detection.

## Requirements

This library requires PHP 7.4+.
Also a PSR-3 compatible logger is required.

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

## Issues and feature requests

Please report your issues and ask for new features on the GitHub Issue Tracker
at https://github.com/mimmi20/ua-result/issues
