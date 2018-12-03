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
namespace UaResultTest\Engine;

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use UaResult\Company\Company;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineFactory;

class EngineTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $object = new Engine($name, $manufacturer, $version);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
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

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = (new VersionFactory())->set('0.0.2-beta');

        $companyLoader = $this->createMock(LoaderInterface::class);

        $original = new Engine($name, $manufacturer, $version);

        $array = $original->toArray();

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new EngineFactory($companyLoader))->fromArray($logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
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

        $version = new Version();

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new EngineFactory($companyLoader))->fromArray($logger, []);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
    }

    /**
     * @return void
     */
    public function testFromarrayWithInvalidManufacturer(): void
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

        $name         = 'test';
        $version      = new Version();
        $manufacturer = new Company('Unknown', null);

        $array = [
            'name' => $name,
            'manufacturer' => 'unknown',
        ];

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new EngineFactory($companyLoader))->fromArray($logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($manufacturer, $object->getManufacturer());
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();

        $original = new Engine($name, $manufacturer, $version);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }

    /**
     * @return void
     */
    public function testLoaderError(): void
    {
        $e = new NotFoundException('testmessage');

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
            ->with($e);
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

        $companyLoader = $this->getMockBuilder(LoaderInterface::class)->getMock();
        $companyLoader->expects(self::once())
            ->method('load')
            ->willThrowException($e);

        $name = 'test';

        $array = [
            'name' => $name,
            'manufacturer' => 'unknown',
        ];

        /* @var NullLogger $logger */
        /* @var LoaderInterface $companyLoader */
        (new EngineFactory($companyLoader))->fromArray($logger, $array);
    }
}
