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
namespace UaResultTest\Engine;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Log\NullLogger;
use UaResult\Company\Company;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineFactory;

class EngineTest extends \PHPUnit\Framework\TestCase
{
    public function testSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $object = new Engine($name, $manufacturer, $version);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
    }

    public function testToarray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = (new VersionFactory())->set('0.0.2-beta');

        $original = new Engine($name, $manufacturer, $version);

        $array  = $original->toArray();
        $object = (new EngineFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
    }

    public function testFromEmptyArray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $version = new Version();
        $object  = (new EngineFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
    }

    public function testFromarrayWithInvalidManufacturer()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $name         = 'test';
        $version      = new Version();
        $manufacturer = new Company('Unknown', null);

        $array  = [
            'name'         => $name,
            'manufacturer' => 'unknown',
        ];
        $object = (new EngineFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($manufacturer, $object->getManufacturer());
    }
}
