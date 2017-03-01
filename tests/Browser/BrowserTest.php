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
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Log\NullLogger;
use UaBrowserType\Type;
use UaResult\Browser\Browser;
use UaResult\Browser\BrowserFactory;
use UaResult\Company\Company;

class BrowserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $object = new Browser($name, $manufacturer, $version, $type, $bits, $pdfSupport, $rssSupport, $modus);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($type, $object->getType());
        self::assertSame($bits, $object->getBits());
        self::assertSame($pdfSupport, $object->getPdfSupport());
        self::assertSame($rssSupport, $object->getRssSupport());
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
        self::assertFalse($object->getPdfSupport());
        self::assertFalse($object->getRssSupport());
        self::assertNull($object->getModus());
    }

    public function testToarray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = (new VersionFactory())->set('0.0.2-beta');
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $version, $type, $bits, $pdfSupport, $rssSupport, $modus);

        $array  = $original->toArray();
        $object = (new BrowserFactory())->fromArray($cache, $logger, $array);

        self::assertEquals($original, $object);
    }

    public function testFromEmptyArray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

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
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $name         = 'test';
        $version      = new Version();
        $type         = new Type('unknown');
        $manufacturer = new Company('Unknown', null);

        $array  = [
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
}
