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

use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;

interface DeviceInterface
{
    /**
     * @return string|null
     */
    public function getDeviceName(): ?string;

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getBrand(): CompanyInterface;

    /**
     * @return bool
     */
    public function getDualOrientation(): bool;

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface;

    /**
     * @return string|null
     */
    public function getMarketingName(): ?string;

    /**
     * @return string|null
     */
    public function getPointingMethod(): ?string;

    /**
     * @return int|null
     */
    public function getResolutionHeight(): ?int;

    /**
     * @return int|null
     */
    public function getResolutionWidth(): ?int;

    /**
     * @return \UaDeviceType\TypeInterface
     */
    public function getType(): TypeInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}
