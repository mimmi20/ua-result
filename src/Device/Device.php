<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Device;

use Override;
use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;

final class Device implements DeviceInterface
{
    /** @throws void */
    public function __construct(
        private readonly string | null $deviceName,
        private readonly string | null $marketingName,
        private CompanyInterface $manufacturer,
        private CompanyInterface $brand,
        private TypeInterface $type,
        private DisplayInterface $display,
        private readonly bool | null $dualOrientation,
        private readonly int | null $simCount,
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
    #[Override]
    public function getDeviceName(): string | null
    {
        return $this->deviceName;
    }

    /** @throws void */
    #[Override]
    public function getBrand(): CompanyInterface
    {
        return $this->brand;
    }

    /** @throws void */
    #[Override]
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    #[Override]
    public function getMarketingName(): string | null
    {
        return $this->marketingName;
    }

    /** @throws void */
    #[Override]
    public function getDisplay(): DisplayInterface
    {
        return $this->display;
    }

    /** @throws void */
    #[Override]
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /** @throws void */
    #[Override]
    public function getDualOrientation(): bool | null
    {
        return $this->dualOrientation;
    }

    /** @throws void */
    #[Override]
    public function getSimCount(): int | null
    {
        return $this->simCount;
    }

    /**
     * @return array{deviceName: string|null, marketingName: string|null, manufacturer: string, brand: string, type: string, display: array{width: int|null, height: int|null, touch: bool|null, size: float|null}, dualOrientation: bool|null, simCount: int|null}
     *
     * @throws void
     */
    #[Override]
    public function toArray(): array
    {
        return [
            'deviceName' => $this->deviceName,
            'marketingName' => $this->marketingName,
            'manufacturer' => $this->manufacturer->getType(),
            'brand' => $this->brand->getType(),
            'display' => $this->display->toArray(),
            'type' => $this->type->getType(),
            'dualOrientation' => $this->dualOrientation,
            'simCount' => $this->simCount,
        ];
    }
}
