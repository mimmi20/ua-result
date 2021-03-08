<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device;

use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;

final class Device implements DeviceInterface
{
    /** @var string|null */
    private $deviceName;

    /** @var string|null */
    private $marketingName;

    /** @var \UaResult\Company\CompanyInterface */
    private $manufacturer;

    /** @var \UaResult\Company\CompanyInterface */
    private $brand;

    /** @var \UaResult\Device\DisplayInterface */
    private $display;

    /** @var \UaDeviceType\TypeInterface */
    private $type;

    /**
     * @param string|null                        $deviceName
     * @param string|null                        $marketingName
     * @param \UaResult\Company\CompanyInterface $manufacturer
     * @param \UaResult\Company\CompanyInterface $brand
     * @param \UaDeviceType\TypeInterface        $type
     * @param \UaResult\Device\DisplayInterface  $display
     */
    public function __construct(
        ?string $deviceName,
        ?string $marketingName,
        CompanyInterface $manufacturer,
        CompanyInterface $brand,
        TypeInterface $type,
        DisplayInterface $display
    ) {
        $this->deviceName    = $deviceName;
        $this->marketingName = $marketingName;
        $this->manufacturer  = $manufacturer;
        $this->brand         = $brand;
        $this->type          = $type;
        $this->display       = $display;
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
        $this->display      = clone $this->display;
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
            'type' => $this->type->getType(),
        ];
    }
}
