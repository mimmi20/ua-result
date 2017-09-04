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
use UaResult\Company\CompanyInterface;

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
     * @var \UaResult\Company\CompanyInterface
     */
    private $manufacturer;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $brand;

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
     * @var bool
     */
    private $dualOrientation = false;

    /**
     * @var \UaDeviceType\TypeInterface
     */
    private $type;

    /**
     * @param string|null                             $deviceName
     * @param string|null                             $marketingName
     * @param \UaResult\Company\CompanyInterface|null $manufacturer
     * @param \UaResult\Company\CompanyInterface|null $brand
     * @param \UaDeviceType\TypeInterface|null        $type
     * @param string|null                             $pointingMethod
     * @param int|null                                $resolutionWidth
     * @param int|null                                $resolutionHeight
     * @param bool                                    $dualOrientation
     */
    public function __construct(
        ?string $deviceName = null,
        ?string $marketingName = null,
        ?CompanyInterface $manufacturer = null,
        ?CompanyInterface $brand = null,
        ?TypeInterface $type = null,
        ?string $pointingMethod = null,
        ?int $resolutionWidth = null,
        ?int $resolutionHeight = null,
        bool $dualOrientation = false
    ) {
        $this->deviceName       = $deviceName;
        $this->marketingName    = $marketingName;
        $this->pointingMethod   = $pointingMethod;
        $this->resolutionWidth  = $resolutionWidth;
        $this->resolutionHeight = $resolutionHeight;
        $this->dualOrientation  = $dualOrientation;

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

    public function __clone()
    {
        $this->type         = clone $this->type;
        $this->manufacturer = clone $this->manufacturer;
        $this->brand        = clone $this->brand;
    }

    /**
     * @return string|null
     */
    public function getDeviceName(): ?string
    {
        return $this->deviceName;
    }

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getBrand(): CompanyInterface
    {
        return $this->brand;
    }

    /**
     * @return bool
     */
    public function getDualOrientation(): bool
    {
        return $this->dualOrientation;
    }

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getMarketingName(): ?string
    {
        return $this->marketingName;
    }

    /**
     * @return string|null
     */
    public function getPointingMethod(): ?string
    {
        return $this->pointingMethod;
    }

    /**
     * @return int|null
     */
    public function getResolutionHeight(): ?int
    {
        return $this->resolutionHeight;
    }

    /**
     * @return int|null
     */
    public function getResolutionWidth(): ?int
    {
        return $this->resolutionWidth;
    }

    /**
     * @return \UaDeviceType\TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return (bool|int|string|null)[]
     */
    public function toArray(): array
    {
        return [
            'deviceName'       => $this->deviceName,
            'marketingName'    => $this->marketingName,
            'manufacturer'     => $this->manufacturer->getType(),
            'brand'            => $this->brand->getType(),
            'pointingMethod'   => $this->pointingMethod,
            'resolutionWidth'  => $this->resolutionWidth,
            'resolutionHeight' => $this->resolutionHeight,
            'dualOrientation'  => $this->dualOrientation,
            'type'             => $this->type->getType(),
        ];
    }
}
