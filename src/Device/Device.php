<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2023, Thomas Mueller <mimmi20@live.de>
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
    /** @throws void */
    public function __construct(
        private string | null $deviceName,
        private string | null $marketingName,
        private CompanyInterface $manufacturer,
        private CompanyInterface $brand,
        private TypeInterface $type,
        private DisplayInterface $display,
    ) {
        // nothing to do
    }

    /**
     * clones the actual object
     *
     * @return void
     *
     * @throws void
     */
    public function __clone()
    {
        $this->type         = clone $this->type;
        $this->manufacturer = clone $this->manufacturer;
        $this->brand        = clone $this->brand;
        $this->display      = clone $this->display;
    }

    /** @throws void */
    public function getDeviceName(): string | null
    {
        return $this->deviceName;
    }

    /** @throws void */
    public function getBrand(): CompanyInterface
    {
        return $this->brand;
    }

    /** @throws void */
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    public function getMarketingName(): string | null
    {
        return $this->marketingName;
    }

    /** @throws void */
    public function getDisplay(): DisplayInterface
    {
        return $this->display;
    }

    /** @throws void */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return array<string, (array<string, (bool|float|int|null)>|string|null)>
     *
     * @throws void
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
