<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResultTest\Result;

use Psr\Log\NullLogger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use UaResult\Browser\Browser;
use UaResult\Device\Device;
use UaResult\Engine\Engine;
use UaResult\Os\Os;
use UaResult\Result\Result;
use UaResult\Result\ResultFactory;
use Wurfl\Request\GenericRequestFactory;

class ResultTest extends \PHPUnit\Framework\TestCase
{
    public function testSetterGetter()
    {
        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestFromString('test-ua');

        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $object = new Result($request, $device, $os, $browser, $engine);

        self::assertSame($request, $object->getRequest());
        self::assertSame($device, $object->getDevice());
        self::assertSame($os, $object->getOs());
        self::assertSame($browser, $object->getBrowser());
        self::assertSame($engine, $object->getEngine());
    }

    public function testToarray()
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestFromString('test-ua');

        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($request, $device, $os, $browser, $engine);
        $array    = $original->toArray();
        $object   = (new ResultFactory())->fromArray($cache, $logger, $array);

        self::assertEquals($request, $object->getRequest());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
    }

    public function testFromEmptyArray()
    {
        $cache  = new FilesystemAdapter('', 0, __DIR__ . '/../cache/');
        $logger = new NullLogger();

        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestFromString('');

        $device  = new Device(null, null);
        $os      = new Os(null, null);
        $browser = new Browser(null);
        $engine  = new Engine(null);

        $object = (new ResultFactory())->fromArray($cache, $logger, []);

        self::assertEquals($request, $object->getRequest());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
    }

    public function testClone()
    {
        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestFromString('test-ua');

        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($request, $device, $os, $browser, $engine);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($device, $cloned->getDevice());
        self::assertNotSame($os, $cloned->getOs());
        self::assertNotSame($browser, $cloned->getBrowser());
        self::assertNotSame($engine, $cloned->getEngine());
    }
}
