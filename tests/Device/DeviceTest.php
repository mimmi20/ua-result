<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResultTest\Device;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Log\NullLogger;
use UaDeviceType\Type;
use UaResult\Company\Company;
use UaResult\Device\Device;
use UaResult\Device\DeviceFactory;

class DeviceTest extends \PHPUnit\Framework\TestCase
{
    public function testSetterGetter()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('Unknown', null);
        $brand             = new Company('Unknown', null);
        $type              = new Type('unknown', 'unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;

        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertSame($pointingMethod, $object->getPointingMethod());
        self::assertSame($resolutionWidth, $object->getResolutionWidth());
        self::assertSame($resolutionHeight, $object->getResolutionHeight());
        self::assertSame($dualOrientation, $object->getDualOrientation());
    }

    public function testToarray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('Unknown', null);
        $brand             = new Company('Unknown', null);
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation);

        $array  = $original->toArray();
        $object = (new DeviceFactory())->fromArray($cache, $logger, $array);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertSame($pointingMethod, $object->getPointingMethod());
        self::assertSame($resolutionWidth, $object->getResolutionWidth());
        self::assertSame($resolutionHeight, $object->getResolutionHeight());
        self::assertSame($dualOrientation, $object->getDualOrientation());
    }

    public function testFromEmptyArray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $manufacturer = new Company('Unknown', null);
        $brand        = new Company('Unknown', null);
        $type         = new Type('unknown');

        $object = (new DeviceFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getDeviceName());
        self::assertNull($object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertNull($object->getPointingMethod());
        self::assertNull($object->getResolutionWidth());
        self::assertNull($object->getResolutionHeight());
        self::assertNull($object->getDualOrientation());
    }

    public function testFromarrayWithInvalidType()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $name         = 'test';
        $type         = new Type('unknown');
        $manufacturer = new Company('Unknown', null);

        $array  = [
            'deviceName'   => $name,
            'type'         => 'does-not-exist',
            'manufacturer' => 'unknown',
            'brand'        => 'does-not-exist',
        ];

        $object = (new DeviceFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getDeviceName());
        self::assertEquals($type, $object->getType());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($manufacturer, $object->getBrand());
    }
}
