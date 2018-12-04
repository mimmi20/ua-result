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

use BrowserDetector\Loader\NotFoundException;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use UaResult\Device\Display;
use UaResult\Device\DisplayFactory;
use UaResult\Device\DisplayType\Unknown;

class DisplayTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = new Unknown();

        $object = new Display($width, $height, $touch, $display);

        self::assertSame($width, $object->getWidth());
        self::assertSame($height, $object->getHeight());
        self::assertSame($touch, $object->hasTouch());
        self::assertSame($display, $object->getType());
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

        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = new Unknown();

        $original = new Display($width, $height, $touch, $display);

        $array = $original->toArray();

        self::assertArrayHasKey('width', $array);
        self::assertArrayHasKey('height', $array);
        self::assertArrayHasKey('touch', $array);
        self::assertArrayHasKey('type', $array);

        /** @var NullLogger $logger */
        $object = (new DisplayFactory())->fromArray($logger, $array);

        self::assertSame($width, $object->getWidth());
        self::assertSame($height, $object->getHeight());
        self::assertSame($touch, $object->hasTouch());
        self::assertEquals($display, $object->getType());
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

        $display = new Unknown();

        /** @var NullLogger $logger */
        $object = (new DisplayFactory())->fromArray($logger, []);

        self::assertNull($object->getWidth());
        self::assertNull($object->getHeight());
        self::assertNull($object->hasTouch());
        self::assertEquals($display, $object->getType());
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
            ->with(new NotFoundException('the display type type with key "does-not-exist" was not found'));
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

        $array = [
            'type' => 'does-not-exist',
        ];

        $display = new Unknown();

        /** @var NullLogger $logger */
        $object = (new DisplayFactory())->fromArray($logger, $array);

        self::assertNull($object->getWidth());
        self::assertNull($object->getHeight());
        self::assertNull($object->hasTouch());
        self::assertEquals($display, $object->getType());
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = new Unknown();

        $original = new Display($width, $height, $touch, $display);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($display, $cloned->getType());
    }
}
