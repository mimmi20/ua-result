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
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UaResult\Company\Company;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineFactory;

class EngineTest extends \PHPUnit\Framework\TestCase
{
    public function testSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $object = new Engine($name, $manufacturer, $version);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
    }

    public function testToarray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = VersionFactory::set('0.0.2-beta');

        $original = new Engine($name, $manufacturer, $version);

        $array  = $original->toArray();
        $object = (new EngineFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
    }

    public function testFromEmptyArray(): void
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $version = new Version();
        $object  = (new EngineFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
    }

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
        $object = (new EngineFactory())->fromArray($cache, $logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($manufacturer, $object->getManufacturer());
    }

    public function testClone(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $original = new Engine($name, $manufacturer, $version);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }
}
