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

interface MarketInterface
{
    /**
     * @return array
     */
    public function getRegions(): array;

    /**
     * @return array
     */
    public function getCountries(): array;

    /**
     * @return array
     */
    public function getVendors(): array;

    /**
     * @return array
     */
    public function toArray(): array;
}
