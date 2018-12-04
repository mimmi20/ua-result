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
namespace UaResultTest\Browser;

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use UaBrowserType\Unknown;
use UaResult\Browser\Browser;
use UaResult\Browser\BrowserFactory;
use UaResult\Company\Company;

class BrowserTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Unknown();
        $bits         = 64;
        $modus        = 'Desktop Mode';

        $object = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($type, $object->getType());
        self::assertSame($bits, $object->getBits());
        self::assertSame($modus, $object->getModus());
    }

    /**
     * @return void
     */
    public function testDefaultSetterGetter(): void
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = new Version();
        $type         = new Unknown();

        $object = new Browser($name);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
        self::assertNull($object->getBits());
        self::assertNull($object->getModus());
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

        $name         = 'TestBrowser';
        $manufacturer = new Company('Unknown', null);
        $version      = (new VersionFactory())->set('0.0.2-beta');
        $type         = new Unknown();
        $bits         = 64;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $version, $type, $bits, $modus);

        $array = $original->toArray();

        self::assertArrayHasKey('name', $array);
        self::assertInternalType('string', $array['name']);
        self::assertArrayHasKey('modus', $array);
        self::assertArrayHasKey('version', $array);
        self::assertInternalType('string', $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertInternalType('string', $array['manufacturer']);
        self::assertArrayHasKey('bits', $array);
        self::assertArrayHasKey('type', $array);
        self::assertInternalType('string', $array['type']);

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new BrowserFactory($companyLoader))->fromArray($logger, $array);

        self::assertEquals($original, $object);
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
        $type    = new Unknown();

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new BrowserFactory($companyLoader))->fromArray($logger, []);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
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
            ->with(new NotFoundException('the browser type with key "does-not-exist" was not found'));
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
        $type         = new Unknown();
        $manufacturer = new Company('Unknown', null);

        $array = [
            'name' => $name,
            'type' => 'does-not-exist',
            'manufacturer' => 'unknown',
        ];

        /** @var NullLogger $logger */
        /** @var LoaderInterface $companyLoader */
        $object = (new BrowserFactory($companyLoader))->fromArray($logger, $array);

        self::assertSame($name, $object->getName());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($type, $object->getType());
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
        $type         = new Unknown();

        $original = new Browser($name, $manufacturer, $version, $type);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
        self::assertNotSame($type, $cloned->getType());
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
            'type' => 'browser',
            'manufacturer' => 'unknown',
        ];

        /* @var NullLogger $logger */
        /* @var LoaderInterface $companyLoader */
        (new BrowserFactory($companyLoader))->fromArray($logger, $array);
    }
}
