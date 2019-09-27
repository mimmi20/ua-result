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

        static::assertSame($deviceName, $object->getDeviceName());
        static::assertSame($marketingName, $object->getMarketingName());
        static::assertSame($manufacturer, $object->getManufacturer());
        static::assertSame($brand, $object->getBrand());
        static::assertSame($type, $object->getType());
        static::assertSame($display, $object->getDisplay());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\MockObject\RuntimeException
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
        $manufacturer->expects(static::once())
            ->method('getType')
            ->willReturn($manuString);

        $brand = $this->getMockBuilder(CompanyInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $brand->expects(static::once())
            ->method('getType')
            ->willReturn($brandString);

        $type = $this->getMockBuilder(TypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $type->expects(static::once())
            ->method('getType')
            ->willReturn($typeString);

        $display = $this->createMock(DisplayInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display);

        $array = $original->toArray();

        static::assertArrayHasKey('deviceName', $array);
        static::assertIsString($array['deviceName']);
        static::assertArrayHasKey('marketingName', $array);
        static::assertIsString($array['marketingName']);
        static::assertArrayHasKey('manufacturer', $array);
        static::assertIsString($array['manufacturer']);
        static::assertSame($manuString, $array['manufacturer']);
        static::assertArrayHasKey('brand', $array);
        static::assertIsString($array['brand']);
        static::assertSame($brandString, $array['brand']);
        static::assertArrayHasKey('type', $array);
        static::assertIsString($array['type']);
        static::assertSame($typeString, $array['type']);
        static::assertArrayHasKey('display', $array);
        static::assertIsArray($array['display']);
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

        static::assertNotSame($original, $cloned);
        static::assertNotSame($manufacturer, $cloned->getManufacturer());
        static::assertNotSame($brand, $cloned->getBrand());
        static::assertNotSame($type, $cloned->getType());
    }
}
