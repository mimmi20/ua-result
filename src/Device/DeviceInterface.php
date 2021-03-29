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

interface DeviceInterface
{
    public function getDeviceName(): ?string;

    public function getBrand(): CompanyInterface;

    public function getManufacturer(): CompanyInterface;

    public function getMarketingName(): ?string;

    public function getDisplay(): ?DisplayInterface;

    public function getType(): TypeInterface;

    /**
     * @return array<string, (string|array<string, (int|float|bool|null)>|null)>
     */
    public function toArray(): array;
}
