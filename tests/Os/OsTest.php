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

namespace UaResultTest\Os;

use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Company\CompanyInterface;
use UaResult\Os\Os;
use UnexpectedValueException;

use function assert;

final class OsTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $version       = $this->createMock(VersionInterface::class);
        $bits          = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $object = new Os($name, $marketingName, $manufacturer, $version, $bits);

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }

    /**
     * @throws Exception
     * @throws UnexpectedValueException
     */
    public function testToarray(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $versionString = '1.0';
        $bits          = 64;
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
        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);

        $array = $original->toArray();

        self::assertArrayHasKey('name', $array);
        self::assertIsString($array['name']);
        self::assertArrayHasKey('marketingName', $array);
        self::assertIsString($array['marketingName']);
        self::assertArrayHasKey('version', $array);
        self::assertIsString($array['version']);
        self::assertSame($versionString, $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertIsString($array['manufacturer']);
        self::assertSame($manuString, $array['manufacturer']);
        self::assertArrayHasKey('bits', $array);
    }

    /** @throws Exception */
    public function testClone(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $version       = $this->createMock(VersionInterface::class);
        $bits          = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }
}
