<?php
/**
 * Copyright (c) 2012-2015, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
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
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult\Result;

use Psr\Log\LoggerInterface;
use UaHelper\Utils;
use UaMatcher\Company\CompanyInterface;
use UaMatcher\Result\ResultInterface;
use UaMatcher\Version\VersionInterface;
use Wurfl\WurflConstants;

/**
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @property-read $id
 * @property-read $useragent
 */
class Device implements DeviceInterface, \Serializable
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
     * @var \UaMatcher\Version\VersionInterface|null
     */
    private $version = null;

    /**
     * @var \UaMatcher\Company\CompanyInterface|null
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
     * @var boolean|null
     */
    private $dualOrientation = null;

    /**
     * @var int|null
     */
    private $colors = null;

    /**
     * @var boolean|null
     */
    private $smsSupport = null;

    /**
     * @var boolean|null
     */
    private $nfcSupport = null;

    /**
     * @var boolean|null
     */
    private $hasQwertyKeyboard = null;

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
     * @param array $data
     */
    private function setData(array $data)
    {
        if (empty($data['deviceName'])) {
            throw new \InvalidArgumentException('the required argument "deviceName is missing"');
        }

        $this->deviceName = $data['deviceName'];

        if (!empty($data['marketingName'])) {
            $this->marketingName = $data['marketingName'];
        }

        if (!empty($data['version']) && $data['version'] instanceof VersionInterface) {
            $this->version = $data['version'];
        }

        if (!empty($data['manufacturer']) && $data['manufacturer'] instanceof CompanyInterface) {
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
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            array(
                'useragent' => $this->useragent,
                'data'      => array(
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
                )
            )
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $data <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($data)
    {
        $unseriliazedData = unserialize($data);

        $this->useragent = $unseriliazedData['useragent'];
        $this->setData($unseriliazedData['data']);
    }

    /**
     * returns the name of the actual device without version
     *
     * @return string|null
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @return string|null
     */
    public function getDeviceMarketingName()
    {
        return $this->marketingName;
    }

    /**
     * returns the veraion of the actual device
     *
     * @return \UaMatcher\Version\VersionInterface|null
     */
    public function getDeviceVersion()
    {
        return $this->version;
    }

    /**
     * returns the manufacturer of the actual device
     *
     * @return \UaMatcher\Company\CompanyInterface|null
     */
    public function getDeviceManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * returns the brand of the actual device
     *
     * @return string|null
     */
    public function getDeviceBrand()
    {
        return $this->brand;
    }

    /**
     * @return string|null
     */
    public function getDeviceType()
    {
        return $$this->formFactor;
    }

    /**
     * @return string|null
     */
    public function getDevicePointingMethod()
    {
        return $this->pointingMethod;
    }

    /**
     * @return int|null
     */
    public function getDeviceResolutionWidth()
    {
        return $this->resolutionWidth;
    }

    /**
     * @return int|null
     */
    public function getDeviceResolutionHeight()
    {
        return $this->resolutionHeight;
    }

    /**
     * @return boolean|null
     */
    public function hasDeviceDualOrientation()
    {
        return $this->dualOrientation;
    }

    /**
     * @return int|null
     */
    public function getDeviceColors()
    {
        return $this->colors;
    }

    /**
     * @return boolean|null
     */
    public function hasDeviceSmsEnabled()
    {
        return $this->smsSupport;
    }

    /**
     * @return boolean|null
     */
    public function hasDeviceNfcSupport()
    {
        return $this->nfcSupport;
    }

    /**
     * @return boolean|null
     */
    public function hasDeviceQwertyKeyboard()
    {
        return $this->hasQwertyKeyboard;
    }
}
