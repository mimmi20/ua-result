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
    private ?string $deviceName = null;

    private ?string $marketingName = null;

    private CompanyInterface $manufacturer;

    private CompanyInterface $brand;

    private DisplayInterface $display;

    private TypeInterface $type;

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

    public function getDeviceName(): ?string
    {
        return $this->deviceName;
    }

    public function getBrand(): CompanyInterface
    {
        return $this->brand;
    }

    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    public function getMarketingName(): ?string
    {
        return $this->marketingName;
    }

    public function getDisplay(): ?DisplayInterface
    {
        return $this->display;
    }

    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return array<string, (string|array<string, (int|float|bool|null)>|null)>
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
