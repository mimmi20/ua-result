<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device;

use UaDeviceType\TypeInterface;
use UaDeviceType\Unknown;
use UaResult\Company\Company;
use UaResult\Company\CompanyInterface;

class Device implements DeviceInterface
{
    /**
     * @var string|null
     */
    private $deviceName;

    /**
     * @var string|null
     */
    private $marketingName;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $manufacturer;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $brand;

    /**
     * @var \UaResult\Device\DisplayInterface
     */
    private $display;

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
     * @param \UaResult\Device\DisplayInterface|null  $display
     * @param bool                                    $dualOrientation
     */
    public function __construct(
        ?string $deviceName = null,
        ?string $marketingName = null,
        ?CompanyInterface $manufacturer = null,
        ?CompanyInterface $brand = null,
        ?TypeInterface $type = null,
        ?DisplayInterface $display = null,
        bool $dualOrientation = false
    ) {
        $this->deviceName      = $deviceName;
        $this->marketingName   = $marketingName;
        $this->dualOrientation = $dualOrientation;

        if (null === $type) {
            $this->type = new Unknown();
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

        if (null === $display) {
            $this->display = new Display(null, null, null, null);
        } else {
            $this->display = $display;
        }
    }

    /**
     * clones the actual object
     *
     * @return void
     */
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
     * @return \UaResult\Device\DisplayInterface|null
     */
    public function getDisplay(): ?DisplayInterface
    {
        return $this->display;
    }

    /**
     * @return \UaDeviceType\TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'deviceName' => $this->deviceName,
            'marketingName' => $this->marketingName,
            'manufacturer' => $this->manufacturer->getType(),
            'brand' => $this->brand->getType(),
            'display' => $this->display->toArray(),
            'dualOrientation' => $this->dualOrientation,
            'type' => $this->type->getType(),
        ];
    }
}
