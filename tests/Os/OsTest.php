<?php
/**
 * Copyright (c) 2015, 2016, Thomas Mueller <mimmi20@live.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/ua-result
 */

namespace UaResultTest\Os;

use BrowserDetector\Version\Version;
use UaResult\Os\Os;

class OsTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $name          = 'TestBrowser';
        $marketingName = 'TestMarketingname';
        $manufacturer  = 'TestManufacturer';
        $brand         = 'TestBrand';
        $version       = new Version();
        $bits          = 64;

        $object = new Os($name, $marketingName, $manufacturer, $brand, $version, $bits);

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }

    public function testSerialize()
    {
        $name          = 'TestBrowser';
        $marketingName = 'TestMarketingname';
        $manufacturer  = 'TestManufacturer';
        $brand         = 'TestBrand';
        $version       = new Version();
        $bits          = 64;

        $original = new Os($name, $marketingName, $manufacturer, $brand, $version, $bits);

        $serialized = serialize($original);
        $object     = unserialize($serialized);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertEquals($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }
}
