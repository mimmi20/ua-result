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

namespace UaResult\Device;

/**
 * interface for all devices to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface DeviceInterface
{
    /**
     * @return string|null
     */
    public function getDeviceName();

    /**
     * @return string|null
     */
    public function getBrand();

    /**
     * @return int|null
     */
    public function getColors();

    /**
     * @return bool|null
     */
    public function getDualOrientation();

    /**
     * @return bool|null
     */
    public function getHasQwertyKeyboard();

    /**
     * @return string|null
     */
    public function getManufacturer();

    /**
     * @return string|null
     */
    public function getMarketingName();

    /**
     * @return bool|null
     */
    public function getNfcSupport();

    /**
     * @return string|null
     */
    public function getPointingMethod();

    /**
     * @return int|null
     */
    public function getResolutionHeight();

    /**
     * @return int|null
     */
    public function getResolutionWidth();

    /**
     * @return bool|null
     */
    public function getSmsSupport();

    /**
     * @return string
     */
    public function getUseragent();

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion();

    /**
     * @return \UaDeviceType\TypeInterface|null
     */
    public function getType();
}
