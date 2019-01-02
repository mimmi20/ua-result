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
use UaResult\Device\Market;

final class MarketTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetterGetter(): void
    {
        $vendors   = ['Testvendor'];
        $regions   = ['EMEA'];
        $countries = ['China'];

        $object = new Market($vendors, $regions, $countries);

        self::assertSame($vendors, $object->getVendors());
        self::assertSame($regions, $object->getRegions());
        self::assertSame($countries, $object->getCountries());
    }

    /**
     * @return void
     */
    public function testToarray(): void
    {
        $vendors   = ['Testvendor'];
        $regions   = ['EMEA'];
        $countries = ['China'];

        $original = new Market($vendors, $regions, $countries);

        $array = $original->toArray();

        self::assertArrayHasKey('regions', $array);
        self::assertArrayHasKey('countries', $array);
        self::assertArrayHasKey('vendors', $array);
    }
}
