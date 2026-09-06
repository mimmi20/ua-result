<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2026, Thomas Mueller <mimmi20@live.de>
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

        $display = new Display($width, $height, $touch, $size);

        self::assertTrue($display->hasTouch());
        self::assertSame($width, $display->getWidth());
        self::assertSame($height, $display->getHeight());
        self::assertSame($size, $display->getSize());
    }

    /** @throws Exception */
    public function testToarray(): void
    {
        $width  = 1920;
        $height = 1080;
        $touch  = true;
        $size   = 5.7;

        $display = new Display($width, $height, $touch, $size);

        $array = $display->toArray();

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
