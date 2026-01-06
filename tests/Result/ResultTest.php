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

namespace UaResultTest\Result;

use PHPUnit\Event\NoPreviousThrowableException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Browser\BrowserInterface;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\EngineInterface;
use UaResult\Os\OsInterface;
use UaResult\Result\Result;
use UnexpectedValueException;

use function assert;

final class ResultTest extends TestCase
{
    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testSetterGetter(): void
    {
        $headers = ['x-test-header' => 'test-ua'];

        $device = $this->createMock(DeviceInterface::class);
        $device->expects(self::never())
            ->method('getArchitecture');
        $device->expects(self::never())
            ->method('getDeviceName');
        $device->expects(self::never())
            ->method('getBrand');
        $device->expects(self::never())
            ->method('getManufacturer');
        $device->expects(self::never())
            ->method('getMarketingName');
        $device->expects(self::never())
            ->method('getDisplay');
        $device->expects(self::never())
            ->method('getType');
        $device->expects(self::never())
            ->method('getDualOrientation');
        $device->expects(self::never())
            ->method('getSimCount');
        $device->expects(self::never())
            ->method('getBits');
        $device->expects(self::never())
            ->method('toArray');

        $os = $this->createMock(OsInterface::class);
        $os->expects(self::never())
            ->method('getBits');
        $os->expects(self::never())
            ->method('getManufacturer');
        $os->expects(self::never())
            ->method('getName');
        $os->expects(self::never())
            ->method('getMarketingName');
        $os->expects(self::never())
            ->method('getVersion');
        $os->expects(self::never())
            ->method('toArray');
        $os->expects(self::never())
            ->method('withVersion');

        $browser = $this->createMock(BrowserInterface::class);
        $browser->expects(self::never())
            ->method('getName');
        $browser->expects(self::never())
            ->method('getManufacturer');
        $browser->expects(self::never())
            ->method('getModus');
        $browser->expects(self::never())
            ->method('getVersion');
        $browser->expects(self::never())
            ->method('getBits');
        $browser->expects(self::never())
            ->method('getType');
        $browser->expects(self::never())
            ->method('toArray');
        $browser->expects(self::never())
            ->method('withVersion');

        $engine = $this->createMock(EngineInterface::class);
        $engine->expects(self::never())
            ->method('getManufacturer');
        $engine->expects(self::never())
            ->method('getName');
        $engine->expects(self::never())
            ->method('getVersion');
        $engine->expects(self::never())
            ->method('toArray');
        $engine->expects(self::never())
            ->method('withVersion');

        assert($device instanceof DeviceInterface);
        assert($os instanceof OsInterface);
        assert($browser instanceof BrowserInterface);
        assert($engine instanceof EngineInterface);
        $object = new Result($headers, $device, $os, $browser, $engine);

        self::assertSame($headers, $object->getHeaders());
        self::assertSame($device, $object->getDevice());
        self::assertSame($os, $object->getOs());
        self::assertSame($browser, $object->getBrowser());
        self::assertSame($engine, $object->getEngine());
    }

    /**
     * @throws Exception
     * @throws UnexpectedValueException
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testToArray(): void
    {
        $headers = ['x-test-header' => 'test-ua'];

        $device = $this->createMock(DeviceInterface::class);
        $device->expects(self::never())
            ->method('getArchitecture');
        $device->expects(self::never())
            ->method('getDeviceName');
        $device->expects(self::never())
            ->method('getBrand');
        $device->expects(self::never())
            ->method('getManufacturer');
        $device->expects(self::never())
            ->method('getMarketingName');
        $device->expects(self::never())
            ->method('getDisplay');
        $device->expects(self::never())
            ->method('getType');
        $device->expects(self::never())
            ->method('getDualOrientation');
        $device->expects(self::never())
            ->method('getSimCount');
        $device->expects(self::never())
            ->method('getBits');
        $device->expects(self::once())
            ->method('toArray')
            ->willReturn([]);

        $os = $this->createMock(OsInterface::class);
        $os->expects(self::never())
            ->method('getBits');
        $os->expects(self::never())
            ->method('getManufacturer');
        $os->expects(self::never())
            ->method('getName');
        $os->expects(self::never())
            ->method('getMarketingName');
        $os->expects(self::never())
            ->method('getVersion');
        $os->expects(self::once())
            ->method('toArray')
            ->willReturn([]);
        $os->expects(self::never())
            ->method('withVersion');

        $browser = $this->createMock(BrowserInterface::class);
        $browser->expects(self::never())
            ->method('getName');
        $browser->expects(self::never())
            ->method('getManufacturer');
        $browser->expects(self::never())
            ->method('getModus');
        $browser->expects(self::never())
            ->method('getVersion');
        $browser->expects(self::never())
            ->method('getBits');
        $browser->expects(self::never())
            ->method('getType');
        $browser->expects(self::once())
            ->method('toArray')
            ->willReturn([]);
        $browser->expects(self::never())
            ->method('withVersion');

        $engine = $this->createMock(EngineInterface::class);
        $engine->expects(self::never())
            ->method('getManufacturer');
        $engine->expects(self::never())
            ->method('getName');
        $engine->expects(self::never())
            ->method('getVersion');
        $engine->expects(self::once())
            ->method('toArray')
            ->willReturn([]);
        $engine->expects(self::never())
            ->method('withVersion');

        assert($device instanceof DeviceInterface);
        assert($os instanceof OsInterface);
        assert($browser instanceof BrowserInterface);
        assert($engine instanceof EngineInterface);
        $original = new Result($headers, $device, $os, $browser, $engine);
        $array    = $original->toArray();

        self::assertArrayHasKey('headers', $array);
        self::assertIsArray($array['headers']);
        self::assertArrayHasKey('device', $array);
        self::assertIsArray($array['device']);
        self::assertArrayHasKey('browser', $array);
        self::assertIsArray($array['browser']);
        self::assertArrayHasKey('os', $array);
        self::assertIsArray($array['os']);
        self::assertArrayHasKey('engine', $array);
        self::assertIsArray($array['engine']);
    }

    /**
     * @throws Exception
     * @throws NoPreviousThrowableException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testClone(): void
    {
        $headers = ['x-test-header' => 'test-ua'];

        $device = $this->createMock(DeviceInterface::class);
        $device->expects(self::never())
            ->method('getArchitecture');
        $device->expects(self::never())
            ->method('getDeviceName');
        $device->expects(self::never())
            ->method('getBrand');
        $device->expects(self::never())
            ->method('getManufacturer');
        $device->expects(self::never())
            ->method('getMarketingName');
        $device->expects(self::never())
            ->method('getDisplay');
        $device->expects(self::never())
            ->method('getType');
        $device->expects(self::never())
            ->method('getDualOrientation');
        $device->expects(self::never())
            ->method('getSimCount');
        $device->expects(self::never())
            ->method('getBits');
        $device->expects(self::never())
            ->method('toArray');

        $os = $this->createMock(OsInterface::class);
        $os->expects(self::never())
            ->method('getBits');
        $os->expects(self::never())
            ->method('getManufacturer');
        $os->expects(self::never())
            ->method('getName');
        $os->expects(self::never())
            ->method('getMarketingName');
        $os->expects(self::never())
            ->method('getVersion');
        $os->expects(self::never())
            ->method('toArray');
        $os->expects(self::never())
            ->method('withVersion');

        $browser = $this->createMock(BrowserInterface::class);
        $browser->expects(self::never())
            ->method('getName');
        $browser->expects(self::never())
            ->method('getManufacturer');
        $browser->expects(self::never())
            ->method('getModus');
        $browser->expects(self::never())
            ->method('getVersion');
        $browser->expects(self::never())
            ->method('getBits');
        $browser->expects(self::never())
            ->method('getType');
        $browser->expects(self::never())
            ->method('toArray');
        $browser->expects(self::never())
            ->method('withVersion');

        $engine = $this->createMock(EngineInterface::class);
        $engine->expects(self::never())
            ->method('getManufacturer');
        $engine->expects(self::never())
            ->method('getName');
        $engine->expects(self::never())
            ->method('getVersion');
        $engine->expects(self::never())
            ->method('toArray');
        $engine->expects(self::never())
            ->method('withVersion');

        assert($device instanceof DeviceInterface);
        assert($os instanceof OsInterface);
        assert($browser instanceof BrowserInterface);
        assert($engine instanceof EngineInterface);
        $original = new Result($headers, $device, $os, $browser, $engine);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($device, $cloned->getDevice());
        self::assertNotSame($os, $cloned->getOs());
        self::assertNotSame($browser, $cloned->getBrowser());
        self::assertNotSame($engine, $cloned->getEngine());
    }
}
