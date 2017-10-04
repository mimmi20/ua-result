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
namespace UaResultTest\Os;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UaResult\Company\Company;
use UaResult\Os\Os;
use UaResult\Os\OsFactory;

class OsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = new Company('Unknown', null);
        $version       = new Version();
        $bits          = 64;

        $object = new Os($name, $marketingName, $manufacturer, $version, $bits);

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = new Company('Unknown', null);
        $version       = VersionFactory::set('0.0.0');
        $bits          = 64;

        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);

        $array  = $original->toArray();
        $object = (new OsFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }

    /**
     * @return void
     */
    public function testFromEmptyArray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $object = (new OsFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getName());
        self::assertNull($object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
        self::assertNull($object->getBits());
    }

    /**
     * @return void
     */
    public function testFromarrayWithInvalidManufacturer(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name         = 'test';
        $version      = new Version();
        $manufacturer = new Company('Unknown', null);

        $array = [
            'name'         => $name,
            'manufacturer' => 'unknown',
        ];
        $object = (new OsFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($manufacturer, $object->getManufacturer());
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = new Company('Unknown', null);
        $version       = new Version();
        $bits          = 64;

        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }
}
