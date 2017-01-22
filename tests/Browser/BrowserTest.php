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

namespace UaResultTest\Browser;

use BrowserDetector\Version\Version;
use UaBrowserType\Type;
use UaResult\Browser\Browser;
use UaResult\Browser\BrowserFactory;
use UaResult\Engine\Engine;

class BrowserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $name         = 'TestBrowser';
        $manufacturer = 'TestManufacturer';
        $brand        = 'TestBrand';
        $version      = new Version();
        $engine       = new Engine('TestEngine', 'TestEngineManufacturer', 'TestEngineBrand');
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $object = new Browser($name, $manufacturer, $brand, $version, $engine, $type, $bits, $pdfSupport, $rssSupport, $modus);

        self::assertSame($name, $object->getName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($version, $object->getVersion());
        self::assertSame($engine, $object->getEngine());
        self::assertSame($type, $object->getType());
        self::assertSame($bits, $object->getBits());
        self::assertSame($pdfSupport, $object->getPdfSupport());
        self::assertSame($rssSupport, $object->getRssSupport());
        self::assertSame($modus, $object->getModus());
    }

    public function testSerialize()
    {
        $name         = 'TestBrowser';
        $manufacturer = 'TestManufacturer';
        $brand        = 'TestBrand';
        $version      = new Version();
        $engine       = new Engine('TestEngine', 'TestEngineManufacturer', 'TestEngineBrand');
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $brand, $version, $engine, $type, $bits, $pdfSupport, $rssSupport, $modus);

        $serialized = serialize($original);
        $object     = unserialize($serialized);

        self::assertEquals($original, $object);
    }

    public function testToarray()
    {
        $name         = 'TestBrowser';
        $manufacturer = 'TestManufacturer';
        $brand        = 'TestBrand';
        $version      = new Version();
        $engine       = new Engine('TestEngine', 'TestEngineManufacturer', 'TestEngineBrand');
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $brand, $version, $engine, $type, $bits, $pdfSupport, $rssSupport, $modus);

        $array      = $original->toArray();
        $object     = (new BrowserFactory())->fromArray($array);

        self::assertEquals($original, $object);
    }

    public function testTojson()
    {
        $name         = 'TestBrowser';
        $manufacturer = 'TestManufacturer';
        $brand        = 'TestBrand';
        $version      = new Version();
        $engine       = new Engine('TestEngine', 'TestEngineManufacturer', 'TestEngineBrand');
        $type         = new Type('unknown');
        $bits         = 64;
        $pdfSupport   = true;
        $rssSupport   = false;
        $modus        = 'Desktop Mode';

        $original = new Browser($name, $manufacturer, $brand, $version, $engine, $type, $bits, $pdfSupport, $rssSupport, $modus);

        $json       = $original->toJson();
        $object     = (new BrowserFactory())->fromJson($json);

        self::assertEquals($original, $object);
    }
}
