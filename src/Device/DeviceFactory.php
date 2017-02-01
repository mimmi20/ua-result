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

use BrowserDetector\Loader\NotFoundException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use UaDeviceType\TypeLoader;
use UaResult\Company\CompanyLoader;

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
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface          $logger
     * @param array                             $data
     *
     * @return \UaResult\Device\Device
     */
    public function fromArray(CacheItemPoolInterface $cache, LoggerInterface $logger, array $data)
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

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = (new TypeLoader($cache))->load($data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = (new CompanyLoader($cache))->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $brand = null;
        if (isset($data['brand'])) {
            try {
                $brand = (new CompanyLoader($cache))->load($data['brand']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Device(
            $deviceName,
            $marketingName,
            $manufacturer,
            $brand,
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
}
