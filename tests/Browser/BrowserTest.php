<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Browser;

use BrowserDetector\Version\VersionInterface;
use InvalidArgumentException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaBrowserType\TypeInterface;
use UaResult\Browser\Browser;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

use function assert;

final class BrowserTest extends TestCase
{
    private const VERSION_STRING = '1.0';
    private const TYPE_STRING    = 'xyz';
    private const MANU_STRING    = 'abc';

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
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
     * @throws InvalidArgumentException
     * @throws Exception
     * @throws UnexpectedValueException
     */
    public function testToarray(): void
    {
        $bits  = 64;
        $modus = 'Desktop Mode';
        $name  = 'TestBrowser';

        $manufacturer = $this->getMockBuilder(CompanyInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $manufacturer->expects(self::once())
            ->method('getType')
            ->willReturn(self::MANU_STRING);

        $version = $this->getMockBuilder(VersionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $version->expects(self::once())
            ->method('getVersion')
            ->willReturn(self::VERSION_STRING);

        $type = $this->getMockBuilder(TypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type->expects(self::once())
            ->method('getType')
            ->willReturn(self::TYPE_STRING);

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
        self::assertSame(self::VERSION_STRING, $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertIsString($array['manufacturer']);
        self::assertSame(self::MANU_STRING, $array['manufacturer']);
        self::assertArrayHasKey('bits', $array);
        self::assertArrayHasKey('type', $array);
        self::assertIsString($array['type']);
        self::assertSame(self::TYPE_STRING, $array['type']);
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
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
