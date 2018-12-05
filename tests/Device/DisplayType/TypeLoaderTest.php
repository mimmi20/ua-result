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
namespace UaResultTest\Device\DisplayType;

use PHPUnit\Framework\TestCase;
use UaResult\Device\DisplayType\TypeLoader;
use UaResult\Device\DisplayType\Unknown;

/**
 * Test class for \BrowserDetector\Loader\BrowserLoader
 */
final class TypeLoaderTest extends TestCase
{
    /**
     * @var \UaResult\Device\DisplayType\TypeLoader
     */
    private $object;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new TypeLoader();
    }

    /**
     * @return void
     */
    public function testHasUnknown(): void
    {
        self::assertTrue($this->object->has('unknown'));
    }

    /**
     * @return void
     */
    public function testHasNotWong(): void
    {
        self::assertFalse($this->object->has('does not exist'));
    }

    /**
     * @return void
     */
    public function testLoadUnknown(): void
    {
        $type = $this->object->load('unknown');

        self::assertInstanceOf(Unknown::class, $type);
        self::assertNull($type->getWidth());
    }

    /**
     * @return void
     */
    public function testLoadNotAvailable(): void
    {
        $this->expectException(\BrowserDetector\Loader\NotFoundException::class);
        $this->expectExceptionMessage('the display type type with key "does not exist" was not found');

        $this->object->load('does not exist');
    }
}
