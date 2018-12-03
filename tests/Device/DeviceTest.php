<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResultTest\Device;

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use UaDeviceType\Unknown;
use UaResult\Company\Company;
use UaResult\Device\Device;
use UaResult\Device\DeviceFactory;
use UaResult\Device\Display;
use UaResult\Device\DisplayFactory;

class DeviceTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = new Company('Unknown', null);
        $brand           = new Company('Unknown', null);
        $type            = new Unknown();
        $display         = new Display(null, null, null, null);
        $dualOrientation = true;

        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertEquals($display, $object->getDisplay());
        self::assertSame($dualOrientation, $object->getDualOrientation());
    }

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $logger = $this->getMockBuilder(NullLogger::class)
            ->disableOriginalConstructor()
            ->setMethods(['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'])
            ->getMock();
        $logger
            ->expects(self::never())
            ->method('debug');
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $companyLoader = $this->createMock(LoaderInterface::class);

        $display = new Display(null, null, null, null);

        $displayFactory = $this->getMockBuilder(DisplayFactory::class)->getMock();
        $displayFactory->expects(self::once())
            ->method('fromArray')
            ->willReturn($display);

        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = new Company('Unknown', null);
        $brand           = new Company('Unknown', null);
        $type            = new Unknown();
        $dualOrientation = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation);

        $array = $original->toArray();

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        /** @var DisplayFactory $displayFactory */
        $object = (new DeviceFactory($companyLoader, $displayFactory))->fromArray($logger, $array);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertEquals($display, $object->getDisplay());
        self::assertSame($dualOrientation, $object->getDualOrientation());
    }

    /**
     * @return void
     */
    public function testFromEmptyArray(): void
    {
        $logger = $this->getMockBuilder(NullLogger::class)
            ->disableOriginalConstructor()
            ->setMethods(['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'])
            ->getMock();
        $logger
            ->expects(self::never())
            ->method('debug');
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $companyLoader  = $this->createMock(LoaderInterface::class);
        $displayFactory = $this->createMock(DisplayFactory::class);

        $manufacturer = new Company('Unknown', null);
        $brand        = new Company('Unknown', null);
        $type         = new Unknown();
        $display      = new Display(null, null, null, null);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        /** @var DisplayFactory $displayFactory */
        $object = (new DeviceFactory($companyLoader, $displayFactory))->fromArray($logger, []);

        self::assertNull($object->getDeviceName());
        self::assertNull($object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertEquals($display, $object->getDisplay());
        self::assertFalse($object->getDualOrientation());
    }

    /**
     * @return void
     */
    public function testFromarrayWithInvalidType(): void
    {
        $logger = $this->getMockBuilder(NullLogger::class)
            ->disableOriginalConstructor()
            ->setMethods(['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'])
            ->getMock();
        $logger
            ->expects(self::never())
            ->method('debug');
        $logger
            ->expects(self::once())
            ->method('info')
            ->with(new NotFoundException('the device type with key "does-not-exist" was not found'));
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $companyLoader  = $this->createMock(LoaderInterface::class);
        $displayFactory = $this->createMock(DisplayFactory::class);

        $name         = 'test';
        $type         = new Unknown();
        $manufacturer = new Company('Unknown', null);

        $array = [
            'deviceName' => $name,
            'type' => 'does-not-exist',
            'manufacturer' => 'unknown',
            'brand' => 'does-not-exist',
        ];

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        /** @var DisplayFactory $displayFactory */
        $object = (new DeviceFactory($companyLoader, $displayFactory))->fromArray($logger, $array);

        self::assertSame($name, $object->getDeviceName());
        self::assertEquals($type, $object->getType());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($manufacturer, $object->getBrand());
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = new Company('Unknown', null);
        $brand           = new Company('Unknown', null);
        $type            = new Unknown();
        $display         = new Display(null, null, null, null);
        $dualOrientation = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertNotSame($type, $cloned->getType());
    }
}
