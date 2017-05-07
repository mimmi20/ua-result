<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device;

use UaDeviceType\Type;
use UaDeviceType\TypeInterface;
use UaResult\Company\Company;

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
     * @var string|null
     */
    private $deviceName = null;

    /**
     * @var string|null
     */
    private $marketingName = null;

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
     * @var \UaDeviceType\TypeInterface|null
     */
    private $type = null;

    /**
     * @param string                           $deviceName
     * @param string                           $marketingName
     * @param \UaResult\Company\Company|null   $manufacturer
     * @param \UaResult\Company\Company|null   $brand
     * @param \UaDeviceType\TypeInterface|null $type
     * @param string|null                      $pointingMethod
     * @param int|null                         $resolutionWidth
     * @param int|null                         $resolutionHeight
     * @param bool|null                        $dualOrientation
     */
    public function __construct(
        $deviceName,
        $marketingName,
        Company $manufacturer = null,
        Company $brand = null,
        TypeInterface $type = null,
        $pointingMethod = null,
        $resolutionWidth = null,
        $resolutionHeight = null,
        $dualOrientation = null
    ) {
        $this->deviceName         = $deviceName;
        $this->marketingName      = $marketingName;
        $this->type               = $type;
        $this->pointingMethod     = $pointingMethod;
        $this->resolutionWidth    = $resolutionWidth;
        $this->resolutionHeight   = $resolutionHeight;
        $this->dualOrientation    = $dualOrientation;

        if (null === $type) {
            $this->type = new Type('unknown');
        } else {
            $this->type = $type;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('Unknown', null);
        } else {
            $this->manufacturer = $manufacturer;
        }

        if (null === $brand) {
            $this->brand = new Company('Unknown', null);
        } else {
            $this->brand = $brand;
        }
    }

    /**
     * @return string|null
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
     * @return bool|null
     */
    public function getDualOrientation()
    {
        return $this->dualOrientation;
    }

    /**
     * @return \UaResult\Company\Company|null
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
     * @return \UaDeviceType\TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'deviceName'        => $this->deviceName,
            'marketingName'     => $this->marketingName,
            'manufacturer'      => $this->manufacturer->getType(),
            'brand'             => $this->brand->getType(),
            'pointingMethod'    => $this->pointingMethod,
            'resolutionWidth'   => $this->resolutionWidth,
            'resolutionHeight'  => $this->resolutionHeight,
            'dualOrientation'   => $this->dualOrientation,
            'type'              => $this->type->getType(),
        ];
    }
}
