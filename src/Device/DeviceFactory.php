<?php
/**
 * Copyright (c) 2012-2016, Thomas Mueller <mimmi20@live.de>
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
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult\Device;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use UaDeviceType\Type;
use UaDeviceType\TypeFactory;
use UaResult\Company\Company;
use UaResult\Company\CompanyFactory;
use UaResult\Os\Os;
use UaResult\Os\OsFactory;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class DeviceFactory
{
    /**
     * @param array $data
     *
     * @return \UaResult\Device\Device
     */
    public function fromArray(array $data)
    {
        $deviceName        = isset($data['deviceName']) ? $data['deviceName'] : null;
        $marketingName     = isset($data['marketingName']) ? $data['marketingName'] : null;
        $pointingMethod    = isset($data['pointingMethod']) ? $data['pointingMethod'] : null;
        $resolutionWidth   = isset($data['resolutionWidth']) ? $data['resolutionWidth'] : null;
        $resolutionHeight  = isset($data['resolutionHeight']) ? $data['resolutionHeight'] : null;
        $dualOrientation   = isset($data['dualOrientation']) ? $data['dualOrientation'] : null;
        $colors            = isset($data['colors']) ? $data['colors'] : null;
        $smsSupport        = isset($data['smsSupport']) ? $data['smsSupport'] : null;
        $nfcSupport        = isset($data['nfcSupport']) ? $data['nfcSupport'] : null;
        $hasQwertyKeyboard = isset($data['hasQwertyKeyboard']) ? $data['hasQwertyKeyboard'] : null;

        if (isset($data['type'])) {
            $type = (new TypeFactory())->fromArray((array) $data['type']);
        } else {
            $type = new Type('unknown');
        }

        if (isset($data['version'])) {
            $version = (new VersionFactory())->fromArray((array) $data['version']);
        } else {
            $version = new Version();
        }

        if (isset($data['platform'])) {
            $platform = (new OsFactory())->fromArray((array) $data['platform']);
        } else {
            $platform = new Os('unknown', 'unknown', 'unknown');
        }

        if (isset($data['manufacturer'])) {
            $manufacturer = (new CompanyFactory())->fromArray((array) $data['manufacturer']);
        } else {
            $manufacturer = new Company('unknown');
        }

        if (isset($data['brand'])) {
            $brand = (new CompanyFactory())->fromArray((array) $data['brand']);
        } else {
            $brand = new Company('unknown');
        }

        return new Device(
            $deviceName,
            $marketingName,
            $manufacturer,
            $brand,
            $version,
            $platform,
            $type,
            $pointingMethod,
            $resolutionWidth,
            $resolutionHeight,
            $dualOrientation,
            $colors,
            $smsSupport,
            $nfcSupport,
            $hasQwertyKeyboard
        );
    }

    /**
     * @param string $json
     *
     * @return \UaResult\Device\Device
     */
    public function fromJson($json)
    {
        return $this->fromArray((array) json_decode($json));
    }
}
