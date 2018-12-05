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

use PHPUnit\Framework\TestCase;
use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;
use UaResult\Device\Device;
use UaResult\Device\DisplayInterface;
use UaResult\Device\MarketInterface;

final class DeviceTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = $this->createMock(CompanyInterface::class);
        $brand           = $this->createMock(CompanyInterface::class);
        $type            = $this->createMock(TypeInterface::class);
        $display         = $this->createMock(DisplayInterface::class);
        $dualOrientation = true;
        $simCount        = 0;
        $market          = $this->createMock(MarketInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        /** @var MarketInterface $market */
        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation, $simCount, $market);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertSame($display, $object->getDisplay());
        self::assertSame($dualOrientation, $object->getDualOrientation());
        self::assertSame($simCount, $object->getSimCount());
        self::assertSame($market, $object->getMarket());
    }

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = $this->createMock(CompanyInterface::class);
        $brand           = $this->createMock(CompanyInterface::class);
        $type            = $this->createMock(TypeInterface::class);
        $display         = $this->createMock(DisplayInterface::class);
        $dualOrientation = true;
        $simCount        = 0;
        $market          = $this->createMock(MarketInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        /** @var MarketInterface $market */
        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation, $simCount, $market);

        $array = $original->toArray();

        self::assertArrayHasKey('deviceName', $array);
        self::assertInternalType('string', $array['deviceName']);
        self::assertArrayHasKey('marketingName', $array);
        self::assertInternalType('string', $array['marketingName']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertInternalType('string', $array['manufacturer']);
        self::assertArrayHasKey('brand', $array);
        self::assertInternalType('string', $array['brand']);
        self::assertArrayHasKey('dualOrientation', $array);
        self::assertInternalType('bool', $array['dualOrientation']);
        self::assertArrayHasKey('type', $array);
        self::assertInternalType('string', $array['type']);
        self::assertArrayHasKey('display', $array);
        self::assertInternalType('array', $array['display']);
        self::assertArrayHasKey('simCount', $array);
        self::assertInternalType('int', $array['simCount']);
        self::assertArrayHasKey('market', $array);
        self::assertInternalType('array', $array['market']);
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $deviceName      = 'TestDevicename';
        $marketingName   = 'TestMarketingname';
        $manufacturer    = $this->createMock(CompanyInterface::class);
        $brand           = $this->createMock(CompanyInterface::class);
        $type            = $this->createMock(TypeInterface::class);
        $display         = $this->createMock(DisplayInterface::class);
        $dualOrientation = true;
        $simCount        = 0;
        $market          = $this->createMock(MarketInterface::class);

        /** @var CompanyInterface $manufacturer */
        /** @var CompanyInterface $brand */
        /** @var TypeInterface $type */
        /** @var DisplayInterface $display */
        /** @var MarketInterface $market */
        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation, $simCount, $market);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($brand, $cloned->getBrand());
        self::assertNotSame($type, $cloned->getType());
        self::assertNotSame($market, $cloned->getMarket());
    }
}
