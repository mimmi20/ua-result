<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2026, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Os;

use BrowserDetector\Version\VersionInterface;
use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaData\CompanyInterface;
use UaResult\Bits\Bits;
use UaResult\Os\Os;
use UnexpectedValueException;

use function assert;

final class OsTest extends TestCase
{
    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testSetterGetter(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';

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

        $bits = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $object = new Os($name, $marketingName, $manufacturer, $version, Bits::from($bits));

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($bits, $object->getBits()->value);
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
        $original = new Os(
            $name,
            $marketingName,
            $manufacturer,
            $version,
            Bits::from($bits),
        );

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
        self::assertSame($bits, $array['bits']->value);
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testClone(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';

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

        $bits = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($version instanceof VersionInterface);
        $original = new Os(
            $name,
            $marketingName,
            $manufacturer,
            $version,
            Bits::from($bits),
        );
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertSame($name, $cloned->getName());
        self::assertSame($marketingName, $cloned->getMarketingName());
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
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';

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

        $bits = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($version1 instanceof VersionInterface);
        $original = new Os(
            $name,
            $marketingName,
            $manufacturer,
            $version1,
            Bits::from($bits),
        );
        $cloned   = $original->withVersion($version2);

        self::assertNotSame($original, $cloned);
        self::assertSame($name, $cloned->getName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertSame($version2, $cloned->getVersion());
        self::assertSame($bits, $cloned->getBits()->value);
    }
}
