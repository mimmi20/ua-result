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

interface DeviceInterface
{
    /** @throws void */
    public function getDeviceName(): string | null;

    /** @throws void */
    public function getBrand(): CompanyInterface;

    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getMarketingName(): string | null;

    /** @throws void */
    public function getDisplay(): DisplayInterface | null;

    /** @throws void */
    public function getType(): TypeInterface;

    /**
     * @return array<string, (array<string, (bool|float|int|null)>|string|null)>
     *
     * @throws void
     */
    public function toArray(): array;
}
