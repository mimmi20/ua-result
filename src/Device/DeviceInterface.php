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

use UaData\CompanyInterface;
use UaDeviceType\TypeInterface;
use UaResult\Bits\Bits;

interface DeviceInterface
{
    /** @throws void */
    public function getArchitecture(): Architecture;

    /** @throws void */
    public function getDeviceName(): string | null;

    /** @throws void */
    public function getBrand(): CompanyInterface;

    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getMarketingName(): string | null;

    /** @throws void */
    public function getDisplay(): DisplayInterface;

    /** @throws void */
    public function getType(): TypeInterface;

    /** @throws void */
    public function getDualOrientation(): bool | null;

    /** @throws void */
    public function getSimCount(): int | null;

    /** @throws void */
    public function getBits(): Bits;

    /**
     * @return array{architecture: Architecture, deviceName: string|null, marketingName: string|null, manufacturer: string, brand: string, type: string, display: array{width: int|null, height: int|null, touch: bool|null, size: float|null}, dualOrientation: bool|null, simCount: int|null, bits: Bits}
     *
     * @throws void
     */
    public function toArray(): array;
}
