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

namespace UaResultTest\Device;

use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaData\CompanyInterface;
use UaDeviceType\Type;
use UaResult\Bits\Bits;
use UaResult\Device\Architecture;
use UaResult\Device\Device;
use UaResult\Device\DisplayInterface;

use function assert;

final class DeviceTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
        );

        self::assertSame($architecture, $device->getArchitecture()->value);
        self::assertSame($deviceName, $device->getDeviceName());
        self::assertSame($marketingName, $device->getMarketingName());
        self::assertSame($manufacturer, $device->getManufacturer());
        self::assertSame($brand, $device->getBrand());
        self::assertSame($type, $device->getType());
        self::assertSame($display, $device->getDisplay());
        self::assertTrue($device->getDualOrientation());
        self::assertSame($simCount, $device->getSimCount());
        self::assertSame($bits, $device->getBits()->value);
        self::assertFalse($device->getIsMobile());
    }

    /** @throws Exception */
    public function testToarray(): void
    {
        $architecture    = 'x64';
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manuString      = 'abc';
        $brandString     = 'def';
        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::once())
            ->method('getKey')
            ->willReturn($manuString);
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::once())
            ->method('getKey')
            ->willReturn($brandString);
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::once())
            ->method('toArray')
            ->willReturn([]);

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
        );

        $array = $device->toArray();

        self::assertArrayHasKey('architecture', $array);
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
        self::assertArrayHasKey('bits', $array);
        self::assertArrayHasKey('ismobile', $array);
        self::assertArrayHasKey('istv', $array);

        self::assertSame($architecture, $array['architecture']->value);
        self::assertSame($deviceName, $array['deviceName']);
        self::assertSame($marketingName, $array['marketingName']);
        self::assertTrue($array['dualOrientation']);
        self::assertSame($simCount, $array['simCount']);
        self::assertSame($bits, $array['bits']->value);
        self::assertFalse($array['ismobile']);
        self::assertFalse($array['istv']);
    }

    /** @throws Exception */
    public function testClone(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
        );
        $cloned = clone $device;

        self::assertNotSame($device, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame($type, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame($architecture, $cloned->getArchitecture()->value);
        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
        self::assertSame($bits, $cloned->getBits()->value);
        self::assertFalse($cloned->getIsMobile());
    }

    /** @throws Exception */
    public function testWithBits(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
        );
        $cloned = $device->withBits(Bits::from(32));

        self::assertNotSame($device, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame($type, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame($architecture, $cloned->getArchitecture()->value);
        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
        self::assertSame(32, $cloned->getBits()->value);
        self::assertFalse($cloned->getIsMobile());
    }

    /** @throws Exception */
    public function testWithArchitecture(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
            isMobile: false,
        );
        $cloned = $device->withArchitecture(Architecture::from('arm'));

        self::assertNotSame($device, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame($type, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame('arm', $cloned->getArchitecture()->value);
        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
        self::assertSame($bits, $cloned->getBits()->value);
        self::assertFalse($cloned->getIsMobile());
    }

    /** @throws Exception */
    public function testWithType(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
            isMobile: true,
        );
        $cloned = $device->withType(Type::Tablet);

        self::assertNotSame($device, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame(Type::Tablet, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame($architecture, $cloned->getArchitecture()->value);
        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
        self::assertSame($bits, $cloned->getBits()->value);
        self::assertTrue($cloned->getIsMobile());
    }

    /** @throws Exception */
    public function testWithIsMobile(): void
    {
        $architecture  = 'x64';
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $manufacturer = $this->createMock(CompanyInterface::class);
        $manufacturer->expects(self::never())
            ->method('getKey');
        $manufacturer->expects(self::never())
            ->method('getName');
        $manufacturer->expects(self::never())
            ->method('getBrandname');

        $brand = $this->createMock(CompanyInterface::class);
        $brand->expects(self::never())
            ->method('getKey');
        $brand->expects(self::never())
            ->method('getName');
        $brand->expects(self::never())
            ->method('getBrandname');

        $type = Type::Phone;

        $display = $this->createMock(DisplayInterface::class);
        $display->expects(self::never())
            ->method('hasTouch');
        $display->expects(self::never())
            ->method('getHeight');
        $display->expects(self::never())
            ->method('getWidth');
        $display->expects(self::never())
            ->method('getSize');
        $display->expects(self::never())
            ->method('toArray');

        $dualOrientation = true;
        $simCount        = 2;
        $bits            = 64;

        assert($manufacturer instanceof CompanyInterface);
        assert($brand instanceof CompanyInterface);
        assert($display instanceof DisplayInterface);
        $device = new Device(
            architecture: Architecture::from($architecture),
            deviceName: $deviceName,
            marketingName: $marketingName,
            manufacturer: $manufacturer,
            brand: $brand,
            type: $type,
            display: $display,
            dualOrientation: $dualOrientation,
            simCount: $simCount,
            bits: Bits::from($bits),
            isMobile: true,
        );
        $cloned = $device->withIsMobile(isMobile: false);

        self::assertNotSame($device, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertSame($type, $cloned->getType());
        self::assertNotSame($display, $cloned->getDisplay());

        self::assertSame($architecture, $cloned->getArchitecture()->value);
        self::assertSame($deviceName, $cloned->getDeviceName());
        self::assertSame($marketingName, $cloned->getMarketingName());
        self::assertTrue($cloned->getDualOrientation());
        self::assertSame($simCount, $cloned->getSimCount());
        self::assertSame($bits, $cloned->getBits()->value);
        self::assertFalse($cloned->getIsMobile());
    }
}
