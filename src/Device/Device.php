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

use UaDeviceType\TypeInterface;
use UaResult\Company\CompanyInterface;

final class Device implements DeviceInterface
{
    /**
     * @var string|null
     */
    private $deviceName;

    /**
     * @var string|null
     */
    private $marketingName;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $manufacturer;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $brand;

    /**
     * @var \UaResult\Device\DisplayInterface
     */
    private $display;

    /**
     * @var bool
     */
    private $dualOrientation = false;

    /**
     * @var \UaDeviceType\TypeInterface
     */
    private $type;

    /**
     * @var int
     */
    private $simCount;

    /**
     * @var \UaResult\Device\MarketInterface
     */
    private $market;

    /**
     * @var array
     */
    private $connections = [];

    /**
     * @param string|null                        $deviceName
     * @param string|null                        $marketingName
     * @param \UaResult\Company\CompanyInterface $manufacturer
     * @param \UaResult\Company\CompanyInterface $brand
     * @param \UaDeviceType\TypeInterface        $type
     * @param \UaResult\Device\DisplayInterface  $display
     * @param bool                               $dualOrientation
     * @param int                                $simCount
     * @param \UaResult\Device\MarketInterface   $market
     * @param array                              $connections
     */
    public function __construct(
        ?string $deviceName,
        ?string $marketingName,
        CompanyInterface $manufacturer,
        CompanyInterface $brand,
        TypeInterface $type,
        DisplayInterface $display,
        bool $dualOrientation,
        int $simCount,
        MarketInterface $market,
        array $connections
    ) {
        $this->deviceName      = $deviceName;
        $this->marketingName   = $marketingName;
        $this->manufacturer    = $manufacturer;
        $this->brand           = $brand;
        $this->type            = $type;
        $this->display         = $display;
        $this->dualOrientation = $dualOrientation;
        $this->simCount        = $simCount;
        $this->market          = $market;
        $this->connections     = $connections;
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
        $this->market       = clone $this->market;
    }

    /**
     * @return string|null
     */
    public function getDeviceName(): ?string
    {
        return $this->deviceName;
    }

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getBrand(): CompanyInterface
    {
        return $this->brand;
    }

    /**
     * @return bool
     */
    public function getDualOrientation(): bool
    {
        return $this->dualOrientation;
    }

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getMarketingName(): ?string
    {
        return $this->marketingName;
    }

    /**
     * @return \UaResult\Device\DisplayInterface|null
     */
    public function getDisplay(): ?DisplayInterface
    {
        return $this->display;
    }

    /**
     * @return \UaDeviceType\TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSimCount(): int
    {
        return $this->simCount;
    }

    /**
     * @return \UaResult\Device\MarketInterface
     */
    public function getMarket(): MarketInterface
    {
        return $this->market;
    }

    /**
     * @return array
     */
    public function getConnections(): array
    {
        return $this->connections;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'deviceName' => $this->deviceName,
            'marketingName' => $this->marketingName,
            'manufacturer' => $this->manufacturer->getType(),
            'brand' => $this->brand->getType(),
            'display' => $this->display->toArray(),
            'dualOrientation' => $this->dualOrientation,
            'type' => $this->type->getType(),
            'simCount' => $this->simCount,
            'market' => $this->market->toArray(),
            'connections' => $this->connections,
        ];
    }
}
