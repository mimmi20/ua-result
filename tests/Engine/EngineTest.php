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
namespace UaResultTest\Engine;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\TestCase;
use UaResult\Company\CompanyInterface;
use UaResult\Engine\Engine;

final class EngineTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = $this->createMock(CompanyInterface::class);
        $version      = $this->createMock(VersionInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $object = new Engine($name, $manufacturer, $version);

        static::assertSame($name, $object->getName());
        static::assertSame($manufacturer, $object->getManufacturer());
        static::assertSame($version, $object->getVersion());
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
        $name          = 'TestBrowser';
        $versionString = '1.0';
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

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $original = new Engine($name, $manufacturer, $version);

        $array = $original->toArray();

        static::assertArrayHasKey('name', $array);
        static::assertIsString($array['name']);
        static::assertArrayHasKey('version', $array);
        static::assertIsString($array['version']);
        static::assertSame($versionString, $array['version']);
        static::assertArrayHasKey('manufacturer', $array);
        static::assertIsString($array['manufacturer']);
        static::assertSame($manuString, $array['manufacturer']);
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

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $original = new Engine($name, $manufacturer, $version);
        $cloned   = clone $original;

        static::assertNotSame($original, $cloned);
        static::assertNotSame($manufacturer, $cloned->getManufacturer());
        static::assertNotSame($version, $cloned->getVersion());
    }
}
