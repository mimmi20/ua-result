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

use PHPUnit\Framework\TestCase;
use UaDisplaySize\DisplayTypeInterface;
use UaResult\Device\Display;

final class DisplayTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = $this->createMock(DisplayTypeInterface::class);
        $size    = 5.7;

        /** @var DisplayTypeInterface $display */
        $object = new Display($width, $height, $touch, $display, $size);

        self::assertSame($width, $object->getWidth());
        self::assertSame($height, $object->getHeight());
        self::assertSame($touch, $object->hasTouch());
        self::assertSame($display, $object->getType());
        self::assertSame($size, $object->getSize());
    }

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = $this->createMock(DisplayTypeInterface::class);
        $size    = 5.7;

        /** @var DisplayTypeInterface $display */
        $original = new Display($width, $height, $touch, $display, $size);

        $array = $original->toArray();

        self::assertArrayHasKey('width', $array);
        self::assertArrayHasKey('height', $array);
        self::assertArrayHasKey('touch', $array);
        self::assertArrayHasKey('type', $array);
        self::assertArrayHasKey('size', $array);
    }

    /**
     * @return void
     */
    public function testClone(): void
    {
        $width   = 4711;
        $height  = 1234;
        $touch   = true;
        $display = $this->createMock(DisplayTypeInterface::class);
        $size    = 5.7;

        /** @var DisplayTypeInterface $display */
        $original = new Display($width, $height, $touch, $display, $size);
        $cloned   = clone $original;

        self::assertNotSame($original, $cloned);
        self::assertNotSame($display, $cloned->getType());
    }
}
