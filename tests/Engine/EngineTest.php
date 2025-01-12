<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Engine;

use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Company\CompanyInterface;
use UaResult\Engine\Engine;
use UnexpectedValueException;

use function assert;

final class EngineTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $object = new Engine($name, $manufacturer, $version);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
    }

    /**
     * @throws Exception
     * @throws UnexpectedValueException
     */
    public function testToarray(): void
    {
        $name          = 'TestBrowser';
        $versionString = '1.0';
        $manuString    = 'abc';

        $manufacturer = $this->getMockBuilder(CompanyInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $manufacturer->expects(self::once())
            ->method('getType')
            ->willReturn($manuString);

        $version = $this->getMockBuilder(VersionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $version->expects(self::once())
            ->method('getVersion')
            ->willReturn($versionString);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $original = new Engine($name, $manufacturer, $version);

        $array = $original->toArray();

        self::assertArrayHasKey('name', $array);
        self::assertIsString($array['name']);
        self::assertArrayHasKey('version', $array);
        self::assertIsString($array['version']);
        self::assertSame($versionString, $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertIsString($array['manufacturer']);
        self::assertSame($manuString, $array['manufacturer']);
    }

    /** @throws Exception */
    public function testClone(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $original = new Engine($name, $manufacturer, $version);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);

        self::assertSame($name, $cloned->getName());
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }

    /** @throws Exception */
    public function testWithVersion(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version1     = $this->createMock(VersionInterface::class);
        $version2     = $this->createMock(VersionInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($version1 instanceof VersionInterface);
        $original = new Engine($name, $manufacturer, $version1);
        $cloned   = $original->withVersion($version2);

        self::assertNotSame($original, $cloned);

        self::assertSame($name, $cloned->getName());
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertSame($version2, $cloned->getVersion());
    }
}
