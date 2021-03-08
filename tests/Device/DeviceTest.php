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
namespace UaResultTest\Device;

use PHPUnit\Framework\TestCase;
use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;
use UaResult\Device\Device;
use UaResult\Device\DisplayInterface;

final class DeviceTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $brand         = $this->createMock(CompanyInterface::class);
        $type          = $this->createMock(TypeInterface::class);
        $display       = $this->createMock(DisplayInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertSame($display, $object->getDisplay());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testToarray(): void
    {
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';
        $typeString    = 'xyz';
        $manuString    = 'abc';
        $brandString   = 'def';

        $manufacturer = $this->getMockBuilder(CompanyInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $manufacturer->expects(self::once())
            ->method('getType')
            ->willReturn($manuString);

        $brand = $this->getMockBuilder(CompanyInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $brand->expects(self::once())
            ->method('getType')
            ->willReturn($brandString);

        $type = $this->getMockBuilder(TypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type->expects(self::once())
            ->method('getType')
            ->willReturn($typeString);

        $display = $this->createMock(DisplayInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display);

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
        self::assertSame($typeString, $array['type']);
        self::assertArrayHasKey('display', $array);
        self::assertIsArray($array['display']);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testClone(): void
    {
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $brand         = $this->createMock(CompanyInterface::class);
        $type          = $this->createMock(TypeInterface::class);
        $display       = $this->createMock(DisplayInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertNotSame($type, $cloned->getType());
    }
}
