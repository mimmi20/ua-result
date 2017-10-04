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

use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UaDeviceType\Type;
use UaResult\Company\Company;
use UaResult\Device\Device;
use UaResult\Device\DeviceFactory;

class DeviceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $deviceName       = 'TestDevicename';
        $marketingName    = 'TestMarketingname';
        $manufacturer     = new Company('Unknown', null);
        $brand            = new Company('Unknown', null);
        $type             = new Type('unknown', 'unknown');
        $pointingMethod   = 'touchscreen';
        $resolutionWidth  = 480;
        $resolutionHeight = 1080;
        $dualOrientation  = true;

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

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $deviceName       = 'TestDevicename';
        $marketingName    = 'TestMarketingname';
        $manufacturer     = new Company('Unknown', null);
        $brand            = new Company('Unknown', null);
        $type             = new Type('unknown');
        $pointingMethod   = 'touchscreen';
        $resolutionWidth  = 480;
        $resolutionHeight = 1080;
        $dualOrientation  = true;

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

    /**
     * @return void
     */
    public function testFromEmptyArray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
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
        self::assertFalse($object->getDualOrientation());
    }

    /**
     * @return void
     */
    public function testFromarrayWithInvalidType(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name         = 'test';
        $type         = new Type('unknown');
        $manufacturer = new Company('Unknown', null);

        $array = [
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

    /**
     * @return void
     */
    public function testClone(): void
    {
        $deviceName       = 'TestDevicename';
        $marketingName    = 'TestMarketingname';
        $manufacturer     = new Company('Unknown', null);
        $brand            = new Company('Unknown', null);
        $type             = new Type('unknown', 'unknown');
        $pointingMethod   = 'touchscreen';
        $resolutionWidth  = 480;
        $resolutionHeight = 1080;
        $dualOrientation  = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertNotSame($type, $cloned->getType());
    }
}
