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

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Log\NullLogger;
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
        $request        = $requestFactory->createRequestForUserAgent('test-ua');

        $device       = new Device(null, null);
        $os           = new Os('unknown', 'unknown');
        $browser      = new Browser('unknown');
        $engine       = new Engine('unknown');

        $object = new Result($request, $device, $os, $browser, $engine);

        self::assertSame($request, $object->getRequest());
        self::assertSame($device, $object->getDevice());
        self::assertSame($os, $object->getOs());
        self::assertSame($browser, $object->getBrowser());
        self::assertSame($engine, $object->getEngine());
    }

    public function testToarray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestForUserAgent('test-ua');

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
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestForUserAgent('');

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
}
