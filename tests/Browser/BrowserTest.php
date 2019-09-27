<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResultTest\Browser;

use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\TestCase;
use UaBrowserType\TypeInterface;
use UaResult\Browser\Browser;
use UaResult\Company\CompanyInterface;

final class BrowserTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $bits         = 64;
        $modus        = 'Desktop Mode';
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);
        $type         = $this->createMock(TypeInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        /** @var TypeInterface $type */
        $object = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        static::assertSame($name, $object->getName());
        static::assertSame($manufacturer, $object->getManufacturer());
        static::assertSame($version, $object->getVersion());
        static::assertSame($type, $object->getType());
        static::assertSame($bits, $object->getBits());
        static::assertSame($modus, $object->getModus());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\MockObject\RuntimeException
     * @throws \PHPUnit\Framework\Exception
     * @throws \UnexpectedValueException
     *
     * @return void
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
        $manufacturer->expects(static::once())
            ->method('getType')
            ->willReturn($manuString);

        $version = $this->getMockBuilder(VersionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $version->expects(static::once())
            ->method('getVersion')
            ->willReturn($versionString);

        $type = $this->getMockBuilder(TypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type->expects(static::once())
            ->method('getType')
            ->willReturn($typeString);

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        /** @var TypeInterface $type */
        $original = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        $array = $original->toArray();

        static::assertArrayHasKey('name', $array);
        static::assertIsString($array['name']);
        static::assertArrayHasKey('modus', $array);
        static::assertArrayHasKey('version', $array);
        static::assertIsString($array['version']);
        static::assertSame($versionString, $array['version']);
        static::assertArrayHasKey('manufacturer', $array);
        static::assertIsString($array['manufacturer']);
        static::assertSame($manuString, $array['manufacturer']);
        static::assertArrayHasKey('bits', $array);
        static::assertArrayHasKey('type', $array);
        static::assertIsString($array['type']);
        static::assertSame($typeString, $array['type']);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testClone(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);
        $type         = $this->createMock(TypeInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        /** @var TypeInterface $type */
        $original = new Browser($name, $manufacturer, $version, $type, null, null);
        $cloned   = clone $original;

        static::assertNotSame($original, $cloned);
        static::assertNotSame($manufacturer, $cloned->getManufacturer());
        static::assertNotSame($version, $cloned->getVersion());
        static::assertNotSame($type, $cloned->getType());
    }
}
