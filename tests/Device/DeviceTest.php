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

namespace UaResultTest\Device;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Log\NullLogger;
use UaDeviceType\Type;
use UaResult\Company\Company;
use UaResult\Device\Device;
use UaResult\Device\DeviceFactory;

class DeviceTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('unknown', 'TestManufacturer');
        $brand             = new Company('unknown', 'TestBrand');
        $type              = new Type('unknown', 'unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($type, $object->getType());
        self::assertSame($pointingMethod, $object->getPointingMethod());
        self::assertSame($resolutionWidth, $object->getResolutionWidth());
        self::assertSame($resolutionHeight, $object->getResolutionHeight());
        self::assertSame($dualOrientation, $object->getDualOrientation());
        self::assertSame($colors, $object->getColors());
        self::assertSame($smsSupport, $object->getSmsSupport());
        self::assertSame($nfcSupport, $object->getNfcSupport());
        self::assertSame($hasQwertyKeyboard, $object->getHasQwertyKeyboard());
    }

    public function testToarray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('unknown', 'unknown');
        $brand             = new Company('unknown', 'unknown');
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        $array  = $original->toArray();
        $object = (new DeviceFactory())->fromArray($cache, $logger, $array);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertSame($pointingMethod, $object->getPointingMethod());
        self::assertSame($resolutionWidth, $object->getResolutionWidth());
        self::assertSame($resolutionHeight, $object->getResolutionHeight());
        self::assertSame($dualOrientation, $object->getDualOrientation());
        self::assertSame($colors, $object->getColors());
        self::assertSame($smsSupport, $object->getSmsSupport());
        self::assertSame($nfcSupport, $object->getNfcSupport());
        self::assertSame($hasQwertyKeyboard, $object->getHasQwertyKeyboard());
    }

    public function testFromEmptyArray()
    {
        $adapter = new Local(__DIR__ . '/../cache/');
        $cache   = new FilesystemCachePool(new Filesystem($adapter));

        $logger = new NullLogger();

        $manufacturer = new Company('unknown', 'unknown');
        $brand        = new Company('unknown', 'unknown');
        $type         = new Type('unknown');

        $object = (new DeviceFactory())->fromArray($cache, $logger, []);

        self::assertNull($object->getDeviceName());
        self::assertNull($object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($type, $object->getType());
        self::assertNull($object->getPointingMethod());
        self::assertNull($object->getResolutionWidth());
        self::assertNull($object->getResolutionHeight());
        self::assertNull($object->getDualOrientation());
        self::assertNull($object->getColors());
        self::assertNull($object->getSmsSupport());
        self::assertNull($object->getNfcSupport());
        self::assertNull($object->getHasQwertyKeyboard());
    }
}
