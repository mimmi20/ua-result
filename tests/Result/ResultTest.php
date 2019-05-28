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
namespace UaResultTest\Result;

use PHPUnit\Framework\TestCase;
use UaResult\Browser\Browser;
use UaResult\Browser\BrowserInterface;
use UaResult\Device\Device;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineInterface;
use UaResult\Os\Os;
use UaResult\Os\OsInterface;
use UaResult\Result\Result;

final class ResultTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

        /** @var DeviceInterface $device */
        /** @var OsInterface $os */
        /** @var BrowserInterface $browser */
        /** @var EngineInterface $engine */
        $object = new Result($headers, $device, $os, $browser, $engine);

        static::assertSame($headers, $object->getHeaders());
        static::assertSame($device, $object->getDevice());
        static::assertSame($os, $object->getOs());
        static::assertSame($browser, $object->getBrowser());
        static::assertSame($engine, $object->getEngine());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \UnexpectedValueException
     *
     * @return void
     */
    public function testToArray(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

        /** @var DeviceInterface $device */
        /** @var OsInterface $os */
        /** @var BrowserInterface $browser */
        /** @var EngineInterface $engine */
        $original = new Result($headers, $device, $os, $browser, $engine);
        $array    = $original->toArray();

        static::assertArrayHasKey('headers', $array);
        static::assertIsArray($array['headers']);
        static::assertArrayHasKey('device', $array);
        static::assertIsArray($array['device']);
        static::assertArrayHasKey('browser', $array);
        static::assertIsArray($array['browser']);
        static::assertArrayHasKey('os', $array);
        static::assertIsArray($array['os']);
        static::assertArrayHasKey('engine', $array);
        static::assertIsArray($array['engine']);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testClone(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = $this->createMock(DeviceInterface::class);
        $os      = $this->createMock(OsInterface::class);
        $browser = $this->createMock(BrowserInterface::class);
        $engine  = $this->createMock(EngineInterface::class);

        /** @var DeviceInterface $device */
        /** @var OsInterface $os */
        /** @var BrowserInterface $browser */
        /** @var EngineInterface $engine */
        $original = new Result($headers, $device, $os, $browser, $engine);
        $cloned   = clone $original;

        static::assertNotSame($original, $cloned);
        static::assertNotSame($device, $cloned->getDevice());
        static::assertNotSame($os, $cloned->getOs());
        static::assertNotSame($browser, $cloned->getBrowser());
        static::assertNotSame($engine, $cloned->getEngine());
    }
}
