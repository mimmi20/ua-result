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

use BrowserDetector\Version\Version;
use UaDeviceType\TypeInterface;

/**
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Device implements DeviceInterface
{
    /**
     * @var string
     */
    private $useragent = null;

    /**
     * @var string|null
     */
    private $deviceName = null;

    /**
     * @var string|null
     */
    private $marketingName = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var string|null
     */
    private $manufacturer = null;

    /**
     * @var string|null
     */
    private $brand = null;

    /**
     * @var string|null
     */
    private $formFactor = null;

    /**
     * @var string|null
     */
    private $pointingMethod = null;

    /**
     * @var int|null
     */
    private $resolutionWidth = null;

    /**
     * @var int|null
     */
    private $resolutionHeight = null;

    /**
     * @var bool|null
     */
    private $dualOrientation = null;

    /**
     * @var int|null
     */
    private $colors = null;

    /**
     * @var bool|null
     */
    private $smsSupport = null;

    /**
     * @var bool|null
     */
    private $nfcSupport = null;

    /**
     * @var bool|null
     */
    private $hasQwertyKeyboard = null;

    /**
     * @var \UaDeviceType\TypeInterface|null
     */
    private $type = null;

    /**
     * the class constructor
     *
     * @param string $useragent
     * @param array  $data
     */
    public function __construct(
        $useragent,
        array $data
    ) {
        $this->useragent = $useragent;

        $this->setData($data);
    }

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
     * @return string|null
     */
    public function getFormFactor()
    {
        return $this->formFactor;
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
        return serialize($this->getData());
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

        $this->useragent = $unseriliazedData['useragent'];
        $this->setData($unseriliazedData['data']);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->getData();
    }

    /**
     * @return array
     */
    private function getData()
    {
        return [
            'useragent' => $this->useragent,
            'data'      => [
                'deviceName'        => $this->deviceName,
                'marketingName'     => $this->marketingName,
                'version'           => $this->version,
                'manufacturer'      => $this->manufacturer,
                'brand'             => $this->brand,
                'formFactor'        => $this->formFactor,
                'pointingMethod'    => $this->pointingMethod,
                'resolutionWidth'   => $this->resolutionWidth,
                'resolutionHeight'  => $this->resolutionHeight,
                'dualOrientation'   => $this->dualOrientation,
                'colors'            => $this->colors,
                'smsSupport'        => $this->smsSupport,
                'nfcSupport'        => $this->nfcSupport,
                'hasQwertyKeyboard' => $this->hasQwertyKeyboard,
                'type'              => $this->type,
            ],
        ];
    }

    /**
     * @param array $data
     */
    private function setData(array $data)
    {
        if (!empty($data['deviceName'])) {
            $this->deviceName = $data['deviceName'];
        }

        if (!empty($data['marketingName'])) {
            $this->marketingName = $data['marketingName'];
        }

        if (!empty($data['version']) && $data['version'] instanceof Version) {
            $this->version = $data['version'];
        }

        if (!empty($data['manufacturer'])) {
            $this->manufacturer = $data['manufacturer'];
        }

        if (!empty($data['brand'])) {
            $this->brand = $data['brand'];
        }

        if (!empty($data['formFactor'])) {
            $this->formFactor = $data['formFactor'];
        }

        if (!empty($data['pointingMethod'])) {
            $this->pointingMethod = $data['pointingMethod'];
        }

        if (!empty($data['resolutionWidth'])) {
            $this->resolutionWidth = $data['resolutionWidth'];
        }

        if (!empty($data['resolutionHeight'])) {
            $this->resolutionHeight = $data['resolutionHeight'];
        }

        if (!empty($data['dualOrientation'])) {
            $this->dualOrientation = $data['dualOrientation'];
        }

        if (!empty($data['colors'])) {
            $this->colors = $data['colors'];
        }

        if (!empty($data['smsSupport'])) {
            $this->smsSupport = $data['smsSupport'];
        }

        if (!empty($data['nfcSupport'])) {
            $this->nfcSupport = $data['nfcSupport'];
        }

        if (!empty($data['hasQwertyKeyboard'])) {
            $this->hasQwertyKeyboard = $data['hasQwertyKeyboard'];
        }

        if (!empty($data['type']) && $data['type'] instanceof TypeInterface) {
            $this->type = $data['type'];
        }
    }
}
