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

namespace UaResult\Browser;

/**
 * base class for all browsers to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface BrowserInterface extends \Serializable, \JsonSerializable
{
    /**
     * gets the name of the browser
     *
     * @return string
     */
    public function getName();

    /**
     * @return bool|null
     */
    public function getCanSkipAlignedLinkRow();

    /**
     * @return bool|null
     */
    public function getClaimsWebSupport();

    /**
     * @return string|null
     */
    public function getManufacturer();

    /**
     * @return string|null
     */
    public function getModus();

    /**
     * @return bool|null
     */
    public function getPdfSupport();

    /**
     * @return bool|null
     */
    public function getRssSupport();

    /**
     * @return bool|null
     */
    public function getSupportsBasicAuthentication();

    /**
     * @return bool|null
     */
    public function getSupportsEmptyOptionValues();

    /**
     * @return bool|null
     */
    public function getSupportsPostMethod();

    /**
     * @return string
     */
    public function getUseragent();

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion();

    /**
     * @return int|null
     */
    public function getBits();

    /**
     * @return \UaBrowserType\TypeInterface|null
     */
    public function getType();
}
