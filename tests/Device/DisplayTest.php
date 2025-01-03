<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Device;

use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Device\Display;

final class DisplayTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $width  = 1920;
        $height = 1080;
        $touch  = true;
        $size   = 5.7;

        $object = new Display($width, $height, $touch, $size);

        self::assertTrue($object->hasTouch());
        self::assertSame($width, $object->getWidth());
        self::assertSame($height, $object->getHeight());
        self::assertSame($size, $object->getSize());
    }

    /** @throws Exception */
    public function testToarray(): void
    {
        $width  = 1920;
        $height = 1080;
        $touch  = true;
        $size   = 5.7;

        $original = new Display($width, $height, $touch, $size);

        $array = $original->toArray();

        self::assertArrayHasKey('width', $array);
        self::assertSame($width, $array['width']);
        self::assertArrayHasKey('height', $array);
        self::assertSame($height, $array['height']);
        self::assertArrayHasKey('touch', $array);
        self::assertTrue($array['touch']);
        self::assertArrayHasKey('size', $array);
        self::assertSame($size, $array['size']);
    }
}
