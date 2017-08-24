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
namespace UaResultTest\Browser;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UaBrowserType\Type;
use UaResult\Browser\Browser;
use UaResult\Browser\BrowserFactory;
use UaResult\Company\Company;

class BrowserTest extends \PHPUnit\Framework\TestCase
{
    public function testSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Type('unknown');
        $bits         = 64;
        $modus        = 'Desktop Mode';

        $object = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($type, $object->getType());
        self::assertSame($bits, $object->getBits());
        self::assertSame($modus, $object->getModus());
    }

    public function testDefaultSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Type('unknown');

        $object = new Browser($name);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
        self::assertNull($object->getBits());
        self::assertNull($object->getModus());
    }

    public function testToarray()
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = VersionFactory::set('0.0.2-beta');
        $type         = new Type('unknown');
        $bits         = 64;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        $array  = $original->toArray();
        $object = (new BrowserFactory())->fromArray($cache, $logger, $array);

        self::assertEquals($original, $object);
    }

    public function testFromEmptyArray()
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $version = new Version();
        $type    = new Type('unknown');

        $object = (new BrowserFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
    }

    public function testFromarrayWithInvalidType()
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name         = 'test';
        $version      = new Version();
        $type         = new Type('unknown');
        $manufacturer = new Company('Unknown', null);

        $array = [
            'name'         => $name,
            'type'         => 'does-not-exist',
            'manufacturer' => 'unknown',
        ];
        $object = (new BrowserFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
        self::assertEquals($manufacturer, $object->getManufacturer());
    }

    public function testClone()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Type('unknown');

        $original = new Browser($name, $manufacturer, $version, $type);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
        self::assertNotSame($type, $cloned->getType());
    }
}
