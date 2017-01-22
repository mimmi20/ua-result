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

namespace UaResultTest\Engine;

use BrowserDetector\Version\Version;
use UaResult\Company\Company;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineFactory;

class EngineTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('TestManufacturer');
        $version      = new Version();

        $object = new Engine($name, $manufacturer, $version);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
    }

    public function testSerialize()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('TestManufacturer');
        $version      = new Version();

        $original = new Engine($name, $manufacturer);

        $serialized = serialize($original);
        $object     = unserialize($serialized);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
    }

    public function testToarray()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('TestManufacturer');
        $version      = new Version();

        $original = new Engine($name, $manufacturer, $version);

        $array  = $original->toArray();
        $object = (new EngineFactory())->fromArray($array);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
    }

    public function testTojson()
    {
        $name         = 'TestBrowser';
        $manufacturer = new Company('TestManufacturer');
        $version      = new Version();

        $original = new Engine($name, $manufacturer, $version);

        $json   = $original->toJson();
        $object = (new EngineFactory())->fromJson($json);

        self::assertSame($name, $object->getName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($version, $object->getVersion());
    }

    public function testFromEmptyArray()
    {
        $version = new Version();
        $object  = (new EngineFactory())->fromArray([]);

        self::assertNull($object->getName());
        self::assertEquals($version, $object->getVersion());
    }
}
