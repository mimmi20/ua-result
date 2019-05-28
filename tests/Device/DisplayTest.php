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
namespace UaResultTest\Device;

use PHPUnit\Framework\TestCase;
use UaDisplaySize\DisplayTypeInterface;
use UaResult\Device\Display;

final class DisplayTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $touch   = true;
        $display = $this->createMock(DisplayTypeInterface::class);
        $size    = 5.7;

        /** @var DisplayTypeInterface $display */
        $object = new Display($touch, $display, $size);

        static::assertTrue($object->hasTouch());
        static::assertSame($display, $object->getType());
        static::assertSame($size, $object->getSize());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\MockObject\RuntimeException
     *
     * @return void
     */
    public function testToarray(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = $this->getMockBuilder(DisplayTypeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $display->expects(static::once())
            ->method('getHeight')
            ->willReturn($height);
        $display->expects(static::once())
            ->method('getWidth')
            ->willReturn($width);
        $size = 5.7;

        /** @var DisplayTypeInterface $display */
        $original = new Display($touch, $display, $size);

        $array = $original->toArray();

        static::assertArrayHasKey('width', $array);
        static::assertSame($width, $array['width']);
        static::assertArrayHasKey('height', $array);
        static::assertSame($height, $array['height']);
        static::assertArrayHasKey('touch', $array);
        static::assertTrue($array['touch']);
        static::assertArrayHasKey('size', $array);
        static::assertSame($size, $array['size']);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testClone(): void
    {
        $touch   = true;
        $display = $this->createMock(DisplayTypeInterface::class);
        $size    = 5.7;

        /** @var DisplayTypeInterface $display */
        $original = new Display($touch, $display, $size);
        $cloned   = clone $original;

        static::assertNotSame($original, $cloned);
        static::assertNotSame($display, $cloned->getType());
    }
}
