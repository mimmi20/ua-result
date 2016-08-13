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
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Device implements DeviceInterface, \Serializable
{
    /**
     * @var string
     */
    protected $useragent = null;

    /**
     * @var string|null
     */
    protected $deviceName = null;

    /**
     * @var string|null
     */
    protected $marketingName = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    protected $version = null;

    /**
     * @var string|null
     */
    protected $manufacturer = null;

    /**
     * @var string|null
     */
    protected $brand = null;

    /**
     * @var string|null
     */
    protected $pointingMethod = null;

    /**
     * @var int|null
     */
    protected $resolutionWidth = null;

    /**
     * @var int|null
     */
    protected $resolutionHeight = null;

    /**
     * @var bool|null
     */
    protected $dualOrientation = null;

    /**
     * @var int|null
     */
    protected $colors = null;

    /**
     * @var bool|null
     */
    protected $smsSupport = null;

    /**
     * @var bool|null
     */
    protected $nfcSupport = null;

    /**
     * @var bool|null
     */
    protected $hasQwertyKeyboard = null;

    /**
     * @var \UaDeviceType\TypeInterface|null
     */
    protected $type = null;

    /**
     * @return string|null
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @return string|null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return int|null
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return bool|null
     */
    public function getDualOrientation()
    {
        return $this->dualOrientation;
    }

    /**
     * @return bool|null
     */
    public function getHasQwertyKeyboard()
    {
        return $this->hasQwertyKeyboard;
    }

    /**
     * @return string|null
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getMarketingName()
    {
        return $this->marketingName;
    }

    /**
     * @return bool|null
     */
    public function getNfcSupport()
    {
        return $this->nfcSupport;
    }

    /**
     * @return string|null
     */
    public function getPointingMethod()
    {
        return $this->pointingMethod;
    }

    /**
     * @return int|null
     */
    public function getResolutionHeight()
    {
        return $this->resolutionHeight;
    }

    /**
     * @return int|null
     */
    public function getResolutionWidth()
    {
        return $this->resolutionWidth;
    }

    /**
     * @return bool|null
     */
    public function getSmsSupport()
    {
        return $this->smsSupport;
    }

    /**
     * @return string
     */
    public function getUseragent()
    {
        return $this->useragent;
    }

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return \UaDeviceType\TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     *
     * @link http://php.net/manual/en/serializable.serialize.php
     *
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            [
                'useragent'         => $this->useragent,
                'deviceName'        => $this->deviceName,
                'marketingName'     => $this->marketingName,
                'version'           => $this->version,
                'manufacturer'      => $this->manufacturer,
                'brand'             => $this->brand,
                'pointingMethod'    => $this->pointingMethod,
                'resolutionWidth'   => $this->resolutionWidth,
                'resolutionHeight'  => $this->resolutionHeight,
                'dualOrientation'   => $this->dualOrientation,
                'colors'            => $this->colors,
                'smsSupport'        => $this->smsSupport,
                'nfcSupport'        => $this->nfcSupport,
                'hasQwertyKeyboard' => $this->hasQwertyKeyboard,
                'type'              => $this->type,
            ]
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     *
     * @link http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $data <p>
     *                     The string representation of the object.
     *                     </p>
     */
    public function unserialize($data)
    {
        $unseriliazedData = unserialize($data);

        $this->useragent         = $unseriliazedData['useragent'];
        $this->deviceName        = $unseriliazedData['deviceName'];
        $this->marketingName     = $unseriliazedData['marketingName'];
        $this->version           = $unseriliazedData['version'];
        $this->manufacturer      = $unseriliazedData['manufacturer'];
        $this->brand             = $unseriliazedData['brand'];
        $this->pointingMethod    = $unseriliazedData['pointingMethod'];
        $this->resolutionWidth   = $unseriliazedData['resolutionWidth'];
        $this->resolutionHeight  = $unseriliazedData['resolutionHeight'];
        $this->dualOrientation   = $unseriliazedData['dualOrientation'];
        $this->colors            = $unseriliazedData['colors'];
        $this->smsSupport        = $unseriliazedData['smsSupport'];
        $this->nfcSupport        = $unseriliazedData['nfcSupport'];
        $this->hasQwertyKeyboard = $unseriliazedData['hasQwertyKeyboard'];
        $this->type              = $unseriliazedData['type'];
    }
}
