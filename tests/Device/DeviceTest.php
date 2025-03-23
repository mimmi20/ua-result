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

namespace UaResultTest\Device;

use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaDeviceType\Type;
use UaResult\Company\CompanyInterface;
use UaResult\Device\Device;
use UaResult\Device\DisplayInterface;

use function assert;

final class DeviceTest extends TestCase
{
    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testSetterGetter(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = $this->createMock(CompanyInterface::class);
        $brand           = $this->createMock(CompanyInterface::class);
        $type            = Type::Phone;
        $display         = $this->createMock(DisplayInterface::class);
        $dualOrientation = true;
        $simCount        = 2;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $object = new Device(
            $deviceName,
            $marketingName,
            $manufacturer,
            $brand,
            $type,
            $display,
            $dualOrientation,
            $simCount,
        );

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertSame($display, $object->getDisplay());
        self::assertTrue($object->getDualOrientation());
        self::assertSame($simCount, $object->getSimCount());
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testToarray(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manuString      = 'abc';
        $brandString     = 'def';
        $dualOrientation = true;
        $simCount        = 2;

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::once())
            ->method('getType')
            ->willReturn($manuString);

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::once())
            ->method('getType')
            ->willReturn($brandString);

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $original = new Device(
            $deviceName,
            $marketingName,
            $manufacturer,
            $brand,
            $type,
            $display,
            $dualOrientation,
            $simCount,
        );

        $array = $original->toArray();

        self::assertArrayHasKey('deviceName', $array);
        self::assertIsString($array['deviceName']);
        self::assertArrayHasKey('marketingName', $array);
        self::assertIsString($array['marketingName']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertIsString($array['manufacturer']);
        self::assertSame($manuString, $array['manufacturer']);
        self::assertArrayHasKey('brand', $array);
        self::assertIsString($array['brand']);
        self::assertSame($brandString, $array['brand']);
        self::assertArrayHasKey('type', $array);
        self::assertIsString($array['type']);
        self::assertSame($type->value, $array['type']);
        self::assertArrayHasKey('display', $array);
        self::assertIsArray($array['display']);
        self::assertArrayHasKey('dualOrientation', $array);
        self::assertArrayHasKey('simCount', $array);

        self::assertSame($deviceName, $array['deviceName']);
        self::assertSame($marketingName, $array['marketingName']);
        self::assertTrue($array['dualOrientation']);
        self::assertSame($simCount, $array['simCount']);
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testClone(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = $this->createMock(CompanyInterface::class);
        $brand           = $this->createMock(CompanyInterface::class);
        $type            = Type::Phone;
        $display         = $this->createMock(DisplayInterface::class);
        $dualOrientation = true;
        $simCount        = 2;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $original = new Device(
            $deviceName,
            $marketingName,
            $manufacturer,
            $brand,
            $type,
            $display,
            $dualOrientation,
            $simCount,
        );
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame($type, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
    }
}
