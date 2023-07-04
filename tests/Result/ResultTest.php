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

namespace UaResultTest\Result;

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
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

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
     */
    public function testToArray(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

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

    /** @throws Exception */
    public function testClone(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

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
