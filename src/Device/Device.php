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
use BrowserDetector\Version\VersionFactory;
use UaDeviceType\Type;
use UaDeviceType\TypeFactory;
use UaDeviceType\TypeInterface;
use UaResult\Company\Company;
use UaResult\Company\CompanyFactory;
use UaResult\Os\Os;
use UaResult\Os\OsFactory;
use UaResult\Os\OsInterface;

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
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

    /**
     * @var \UaResult\Company\Company|null
     */
    private $brand = null;

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
     * @var \UaResult\Os\OsInterface|null
     */
    private $platform = null;

    /**
     * @param string                                $deviceName
     * @param string                                $marketingName
     * @param \UaResult\Company\Company|null        $manufacturer
     * @param \UaResult\Company\Company|null        $brand
     * @param \BrowserDetector\Version\Version|null $version
     * @param \UaResult\Os\OsInterface|null         $platform
     * @param \UaDeviceType\TypeInterface|null      $type
     * @param string|null                           $pointingMethod
     * @param int|null                              $resolutionWidth
     * @param int|null                              $resolutionHeight
     * @param bool|null                             $dualOrientation
     * @param int|null                              $colors
     * @param bool|null                             $smsSupport
     * @param bool|null                             $nfcSupport
     * @param bool|null                             $hasQwertyKeyboard
     */
    public function __construct(
        $deviceName,
        $marketingName,
        Company $manufacturer = null,
        Company $brand = null,
        Version $version = null,
        OsInterface $platform = null,
        TypeInterface $type = null,
        $pointingMethod = null,
        $resolutionWidth = null,
        $resolutionHeight = null,
        $dualOrientation = null,
        $colors = null,
        $smsSupport = null,
        $nfcSupport = null,
        $hasQwertyKeyboard = null
    ) {
        $this->deviceName         = $deviceName;
        $this->marketingName      = $marketingName;
        $this->type               = $type;
        $this->pointingMethod     = $pointingMethod;
        $this->resolutionWidth    = $resolutionWidth;
        $this->resolutionHeight   = $resolutionHeight;
        $this->dualOrientation    = $dualOrientation;
        $this->colors             = $colors;
        $this->smsSupport         = $smsSupport;
        $this->nfcSupport         = $nfcSupport;
        $this->hasQwertyKeyboard  = $hasQwertyKeyboard;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $platform) {
            $this->platform = new Os('unknown', 'unknown', 'unknown');
        } else {
            $this->platform = $platform;
        }

        if (null === $type) {
            $this->type = new Type('unknown');
        } else {
            $this->type = $type;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('unknown');
        } else {
            $this->manufacturer = $manufacturer;
        }

        if (null === $brand) {
            $this->brand = new Company('unknown');
        } else {
            $this->brand = $brand;
        }
    }

    /**
     * @return \UaResult\Company\Company|null
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @return \UaResult\Company\Company|null
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
     * @return \UaResult\Os\OsInterface|null
     */
    public function getPlatform()
    {
        return $this->platform;
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
        return serialize($this->toArray());
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

        $this->fromArray($unseriliazedData);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'deviceName'        => $this->deviceName,
            'marketingName'     => $this->marketingName,
            'version'           => $this->version->toArray(),
            'manufacturer'      => $this->manufacturer->toArray(),
            'brand'             => $this->brand->toArray(),
            'pointingMethod'    => $this->pointingMethod,
            'resolutionWidth'   => $this->resolutionWidth,
            'resolutionHeight'  => $this->resolutionHeight,
            'dualOrientation'   => $this->dualOrientation,
            'colors'            => $this->colors,
            'smsSupport'        => $this->smsSupport,
            'nfcSupport'        => $this->nfcSupport,
            'hasQwertyKeyboard' => $this->hasQwertyKeyboard,
            'type'              => $this->type->toArray(),
            'platform'          => $this->platform->toArray(),
        ];
    }

    /**
     * @param array $data
     */
    private function fromArray(array $data)
    {
        $this->deviceName        = isset($data['deviceName']) ? $data['deviceName'] : null;
        $this->marketingName     = isset($data['marketingName']) ? $data['marketingName'] : null;
        $this->pointingMethod    = isset($data['pointingMethod']) ? $data['pointingMethod'] : null;
        $this->resolutionWidth   = isset($data['resolutionWidth']) ? $data['resolutionWidth'] : null;
        $this->resolutionHeight  = isset($data['resolutionHeight']) ? $data['resolutionHeight'] : null;
        $this->dualOrientation   = isset($data['dualOrientation']) ? $data['dualOrientation'] : null;
        $this->colors            = isset($data['colors']) ? $data['colors'] : null;
        $this->smsSupport        = isset($data['smsSupport']) ? $data['smsSupport'] : null;
        $this->nfcSupport        = isset($data['nfcSupport']) ? $data['nfcSupport'] : null;
        $this->hasQwertyKeyboard = isset($data['hasQwertyKeyboard']) ? $data['hasQwertyKeyboard'] : null;

        if (isset($data['type'])) {
            $this->type = (new TypeFactory())->fromArray((array) $data['type']);
        } else {
            $this->type = new Type('unknown');
        }

        if (isset($data['version'])) {
            $this->version = (new VersionFactory())->fromArray((array) $data['version']);
        } else {
            $this->version = new Version();
        }

        if (isset($data['platform'])) {
            $this->platform = (new OsFactory())->fromArray((array) $data['platform']);
        } else {
            $this->platform = new Os('unknown', 'unknown', 'unknown');
        }

        if (isset($data['manufacturer'])) {
            $this->manufacturer = (new CompanyFactory())->fromArray((array) $data['manufacturer']);
        } else {
            $this->manufacturer = new Company('unknown');
        }

        if (isset($data['brand'])) {
            $this->brand = (new CompanyFactory())->fromArray((array) $data['brand']);
        } else {
            $this->brand = new Company('unknown');
        }
    }
}
