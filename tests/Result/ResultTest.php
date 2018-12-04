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
namespace UaResultTest\Result;

use BrowserDetector\Loader\LoaderInterface;
use JsonClass\Json;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use UaResult\Browser\Browser;
use UaResult\Device\Device;
use UaResult\Engine\Engine;
use UaResult\Os\Os;
use UaResult\Result\Result;
use UaResult\Result\ResultFactory;

class ResultTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $object = new Result($headers, $device, $os, $browser, $engine);

        self::assertSame($headers, $object->getHeaders());
        self::assertSame($device, $object->getDevice());
        self::assertSame($os, $object->getOs());
        self::assertSame($browser, $object->getBrowser());
        self::assertSame($engine, $object->getEngine());
    }

    /**
     * @return void
     */
    public function testToArray(): void
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

        $headers = ['x-test-header' => 'test-ua'];
        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($headers, $device, $os, $browser, $engine);
        $array    = $original->toArray();

        self::assertArrayHasKey('headers', $array);
        self::assertInternalType('array', $array['headers']);
        self::assertArrayHasKey('device', $array);
        self::assertInternalType('array', $array['device']);
        self::assertArrayHasKey('browser', $array);
        self::assertInternalType('array', $array['browser']);
        self::assertArrayHasKey('os', $array);
        self::assertInternalType('array', $array['os']);
        self::assertArrayHasKey('engine', $array);
        self::assertInternalType('array', $array['engine']);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new ResultFactory($companyLoader))->fromArray($logger, $array);

        self::assertEquals($headers, $object->getHeaders());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
    }

    /**
     * @return void
     */
    public function testToArrayWhenFromJson(): void
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

        $headers = ['x-test-header' => 'test-ua'];
        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($headers, $device, $os, $browser, $engine);
        $array    = (new Json())->decode((new Json())->encode($original->toArray()), true);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new ResultFactory($companyLoader))->fromArray($logger, $array);

        self::assertEquals($headers, $object->getHeaders());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
    }

    /**
     * @return void
     */
    public function testToArrayWhenFromJsonObject(): void
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

        $headers = ['x-test-header' => 'test-ua'];
        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($headers, $device, $os, $browser, $engine);
        $array    = (new Json())->decode((new Json())->encode($original->toArray()), false);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new ResultFactory($companyLoader))->fromArray($logger, (array) $array);

        self::assertEquals($headers, $object->getHeaders());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
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

        $companyLoader = $this->createMock(LoaderInterface::class);

        $headers = [];
        $device  = new Device(null, null);
        $os      = new Os(null, null);
        $browser = new Browser(null);
        $engine  = new Engine(null);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new ResultFactory($companyLoader))->fromArray($logger, []);

        self::assertEquals($headers, $object->getHeaders());
        self::assertEquals($device, $object->getDevice());
        self::assertEquals($os, $object->getOs());
        self::assertEquals($browser, $object->getBrowser());
        self::assertEquals($engine, $object->getEngine());
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $headers = ['x-test-header' => 'test-ua'];
        $device  = new Device(null, null);
        $os      = new Os('unknown', 'unknown');
        $browser = new Browser('unknown');
        $engine  = new Engine('unknown');

        $original = new Result($headers, $device, $os, $browser, $engine);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($device, $cloned->getDevice());
        self::assertNotSame($os, $cloned->getOs());
        self::assertNotSame($browser, $cloned->getBrowser());
        self::assertNotSame($engine, $cloned->getEngine());
    }
}
