<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2026, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Device;

use Override;
use UaData\CompanyInterface;
use UaDeviceType\Type;
use UaResult\Bits\Bits;

final class Device implements DeviceInterface
{
    /** @throws void */
    public function __construct(
        private Architecture $architecture,
        private readonly string | null $deviceName,
        private readonly string | null $marketingName,
        private CompanyInterface $manufacturer,
        private CompanyInterface $brand,
        private Type $type,
        private DisplayInterface $display,
        private readonly bool | null $dualOrientation,
        private readonly int | null $simCount,
        private Bits $bits,
        private bool | null $isMobile = null,
    ) {
        // nothing to do
    }

    /**
     * clones the actual object
     *
     * @throws void
     */
    public function __clone()
    {
        $this->manufacturer = clone $this->manufacturer;
        $this->brand        = clone $this->brand;
        $this->display      = clone $this->display;
    }

    /** @throws void */
    #[Override]
    public function withArchitecture(Architecture $architecture): DeviceInterface
    {
        $new               = clone $this;
        $new->architecture = $architecture;

        return $new;
    }

    /** @throws void */
    #[Override]
    public function withType(Type $type): DeviceInterface
    {
        $new       = clone $this;
        $new->type = $type;

        return $new;
    }

    /** @throws void */
    #[Override]
    public function withBits(Bits $bits): DeviceInterface
    {
        $new       = clone $this;
        $new->bits = $bits;

        return $new;
    }

    /** @throws void */
    #[Override]
    public function withIsMobile(bool $isMobile): DeviceInterface
    {
        $new           = clone $this;
        $new->isMobile = $isMobile;

        return $new;
    }

    /** @throws void */
    #[Override]
    public function getArchitecture(): Architecture
    {
        return $this->architecture;
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
    public function getType(): Type
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

    /** @throws void */
    #[Override]
    public function getBits(): Bits
    {
        return $this->bits;
    }

    /** @throws void */
    #[Override]
    public function getIsMobile(): bool
    {
        return $this->isMobile ?? $this->type->isMobile();
    }

    /**
     * @return array{architecture: Architecture, deviceName: string|null, marketingName: string|null, manufacturer: string, brand: string, type: string, ismobile: bool, istv: bool, display: array{width: int|null, height: int|null, touch: bool|null, size: float|null}, dualOrientation: bool|null, simCount: int|null, bits: Bits}
     *
     * @throws void
     */
    #[Override]
    public function toArray(): array
    {
        return [
            'architecture' => $this->architecture,
            'deviceName' => $this->deviceName,
            'marketingName' => $this->marketingName,
            'manufacturer' => $this->manufacturer->getKey(),
            'brand' => $this->brand->getKey(),
            'display' => $this->display->toArray(),
            'type' => $this->type->getType(),
            'ismobile' => $this->isMobile ?? $this->type->isMobile(),
            'istv' => $this->type->isTv(),
            'dualOrientation' => $this->dualOrientation,
            'simCount' => $this->simCount,
            'bits' => $this->bits,
        ];
    }
}
