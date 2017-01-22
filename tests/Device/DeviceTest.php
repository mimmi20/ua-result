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

use BrowserDetector\Version\Version;
use UaDeviceType\Type;
use UaResult\Company\Company;
use UaResult\Device\Device;
use UaResult\Device\DeviceFactory;
use UaResult\Os\Os;

class DeviceTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('TestManufacturer');
        $brand             = new Company('TestBrand');
        $version           = new Version();
        $platform          = new Os('TestOsname', 'TestOsmarketingname');
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $object = new Device($deviceName, $marketingName, $manufacturer, $brand, $version, $platform, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($brand, $object->getBrand());
        self::assertSame($version, $object->getVersion());
        self::assertSame($platform, $object->getPlatform());
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

    public function testSerialize()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('TestManufacturer');
        $brand             = new Company('TestBrand');
        $version           = new Version();
        $platform          = new Os('TestOsname', 'TestOsmarketingname');
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $version, $platform, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        $serialized = serialize($original);
        $object     = unserialize($serialized);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($platform, $object->getPlatform());
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

    public function testToarray()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('TestManufacturer');
        $brand             = new Company('TestBrand');
        $version           = new Version();
        $platform          = new Os('TestOsname', 'TestOsmarketingname');
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $version, $platform, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        $array  = $original->toArray();
        $object = (new DeviceFactory())->fromArray($array);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($platform, $object->getPlatform());
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

    public function testTojson()
    {
        $deviceName        = 'TestDevicename';
        $marketingName     = 'TestMarketingname';
        $manufacturer      = new Company('TestManufacturer');
        $brand             = new Company('TestBrand');
        $version           = new Version();
        $platform          = new Os('TestOsname', 'TestOsmarketingname');
        $type              = new Type('unknown');
        $pointingMethod    = 'touchscreen';
        $resolutionWidth   = 480;
        $resolutionHeight  = 1080;
        $dualOrientation   = true;
        $colors            = '68676';
        $smsSupport        = true;
        $nfcSupport        = false;
        $hasQwertyKeyboard = true;

        $original = new Device($deviceName, $marketingName, $manufacturer, $brand, $version, $platform, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation, $colors, $smsSupport, $nfcSupport, $hasQwertyKeyboard);

        $json   = $original->toJson();
        $object = (new DeviceFactory())->fromJson($json);

        self::assertSame($deviceName, $object->getDeviceName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertEquals($manufacturer, $object->getManufacturer());
        self::assertEquals($brand, $object->getBrand());
        self::assertEquals($version, $object->getVersion());
        self::assertEquals($platform, $object->getPlatform());
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

    public function testTostring()
    {
        $deviceName    = 'TestDevicename';
        $marketingName = 'TestMarketingname';

        $object = new Device($deviceName, $marketingName);

        self::assertSame($deviceName, (string) $object);
    }
}
