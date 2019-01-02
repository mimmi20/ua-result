<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device;

final class Market implements MarketInterface
{
    /**
     * @var array
     */
    private $regions = [];

    /**
     * @var array
     */
    private $countries = [];

    /**
     * @var array
     */
    private $vendors = [];

    /**
     * Market constructor.
     *
     * @param array $vendors
     * @param array $regions
     * @param array $countries
     */
    public function __construct(array $vendors, array $regions, array $countries)
    {
        $this->regions   = $regions;
        $this->countries = $countries;
        $this->vendors   = $vendors;
    }

    /**
     * @return array
     */
    public function getRegions(): array
    {
        return $this->regions;
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @return array
     */
    public function getVendors(): array
    {
        return $this->vendors;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'regions' => $this->regions,
            'countries' => $this->countries,
            'vendors' => $this->vendors,
        ];
    }
}
