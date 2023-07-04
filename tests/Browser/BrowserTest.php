<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Browser;

use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaBrowserType\TypeInterface;
use UaResult\Browser\Browser;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

use function assert;

final class BrowserTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $bits         = 64;
        $modus        = 'Desktop Mode';
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);
        $type         = $this->createMock(TypeInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        assert($type instanceof TypeInterface);
        $object = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($type, $object->getType());
        self::assertSame($bits, $object->getBits());
        self::assertSame($modus, $object->getModus());
    }

    /**
     * @throws Exception
     * @throws UnexpectedValueException
     */
    public function testToarray(): void
    {
        $bits          = 64;
        $modus         = 'Desktop Mode';
        $name          = 'TestBrowser';
        $versionString = '1.0';
        $typeString    = 'xyz';
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

        $type = $this->getMockBuilder(TypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type->expects(self::once())
            ->method('getType')
            ->willReturn($typeString);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        assert($type instanceof TypeInterface);
        $original = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        $array = $original->toArray();

        self::assertArrayHasKey('name', $array);
        self::assertIsString($array['name']);
        self::assertArrayHasKey('modus', $array);
        self::assertArrayHasKey('version', $array);
        self::assertIsString($array['version']);
        self::assertSame($versionString, $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertIsString($array['manufacturer']);
        self::assertSame($manuString, $array['manufacturer']);
        self::assertArrayHasKey('bits', $array);
        self::assertArrayHasKey('type', $array);
        self::assertIsString($array['type']);
        self::assertSame($typeString, $array['type']);
    }

    /** @throws Exception */
    public function testClone(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);
        $type         = $this->createMock(TypeInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        assert($type instanceof TypeInterface);
        $original = new Browser($name, $manufacturer, $version, $type, null, null);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
        self::assertNotSame($type, $cloned->getType());
    }
}
