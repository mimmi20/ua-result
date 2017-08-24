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

use BrowserDetector\Loader\NotFoundException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use UaDeviceType\TypeLoader;
use UaResult\Company\CompanyLoader;

class DeviceFactory
{
    /**
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface          $logger
     * @param string[]                          $data
     *
     * @return \UaResult\Device\DeviceInterface
     */
    public function fromArray(CacheItemPoolInterface $cache, LoggerInterface $logger, array $data): DeviceInterface
    {
        $deviceName       = isset($data['deviceName']) ? $data['deviceName'] : null;
        $marketingName    = isset($data['marketingName']) ? $data['marketingName'] : null;
        $pointingMethod   = isset($data['pointingMethod']) ? $data['pointingMethod'] : null;
        $resolutionWidth  = isset($data['resolutionWidth']) ? $data['resolutionWidth'] : null;
        $resolutionHeight = isset($data['resolutionHeight']) ? $data['resolutionHeight'] : null;
        $dualOrientation  = isset($data['dualOrientation']) ? (bool) $data['dualOrientation'] : false;

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = (new TypeLoader())->load($data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = (new CompanyLoader($cache))->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $brand = null;
        if (isset($data['brand'])) {
            try {
                $brand = (new CompanyLoader($cache))->load($data['brand']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $pointingMethod, $resolutionWidth, $resolutionHeight, $dualOrientation);
    }
}
