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
use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaData\CompanyInterface;
use UaResult\Engine\Engine;
use UnexpectedValueException;

use function assert;

final class EngineTest extends TestCase
{
    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testSetterGetter(): void
    {
        $name = 'TestBrowser';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $version = $this->createMock(VersionInterface::class);
        $version->expects(self::never())
            ->method('getVersion');
        $version->expects(self::never())
            ->method('toArray');
        $version->expects(self::never())
            ->method('getMajor');
        $version->expects(self::never())
            ->method('getMinor');
        $version->expects(self::never())
            ->method('getMicro');
        $version->expects(self::never())
            ->method('getPatch');
        $version->expects(self::never())
            ->method('getMicropatch');
        $version->expects(self::never())
            ->method('getBuild');
        $version->expects(self::never())
            ->method('getStability');
        $version->expects(self::never())
            ->method('isAlpha');
        $version->expects(self::never())
            ->method('isBeta');

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
            ->method('getKey')
            ->willReturn($manuString);
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

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

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testClone(): void
    {
        $name = 'TestBrowser';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $version = $this->createMock(VersionInterface::class);
        $version->expects(self::never())
            ->method('getVersion');
        $version->expects(self::never())
            ->method('toArray');
        $version->expects(self::never())
            ->method('getMajor');
        $version->expects(self::never())
            ->method('getMinor');
        $version->expects(self::never())
            ->method('getMicro');
        $version->expects(self::never())
            ->method('getPatch');
        $version->expects(self::never())
            ->method('getMicropatch');
        $version->expects(self::never())
            ->method('getBuild');
        $version->expects(self::never())
            ->method('getStability');
        $version->expects(self::never())
            ->method('isAlpha');
        $version->expects(self::never())
            ->method('isBeta');

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $original = new Engine($name, $manufacturer, $version);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);

        self::assertSame($name, $cloned->getName());
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testWithVersion(): void
    {
        $name = 'TestBrowser';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $version1 = $this->createMock(VersionInterface::class);
        $version1->expects(self::never())
            ->method('getVersion');
        $version1->expects(self::never())
            ->method('toArray');
        $version1->expects(self::never())
            ->method('getMajor');
        $version1->expects(self::never())
            ->method('getMinor');
        $version1->expects(self::never())
            ->method('getMicro');
        $version1->expects(self::never())
            ->method('getPatch');
        $version1->expects(self::never())
            ->method('getMicropatch');
        $version1->expects(self::never())
            ->method('getBuild');
        $version1->expects(self::never())
            ->method('getStability');
        $version1->expects(self::never())
            ->method('isAlpha');
        $version1->expects(self::never())
            ->method('isBeta');

        $version2 = $this->createMock(VersionInterface::class);
        $version2->expects(self::never())
            ->method('getVersion');
        $version2->expects(self::never())
            ->method('toArray');
        $version2->expects(self::never())
            ->method('getMajor');
        $version2->expects(self::never())
            ->method('getMinor');
        $version2->expects(self::never())
            ->method('getMicro');
        $version2->expects(self::never())
            ->method('getPatch');
        $version2->expects(self::never())
            ->method('getMicropatch');
        $version2->expects(self::never())
            ->method('getBuild');
        $version2->expects(self::never())
            ->method('getStability');
        $version2->expects(self::never())
            ->method('isAlpha');
        $version2->expects(self::never())
            ->method('isBeta');

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
