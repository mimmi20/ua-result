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

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use Psr\Log\LoggerInterface;
use UaDeviceType\TypeLoader;

class DeviceFactory
{
    /**
     * @var \BrowserDetector\Loader\LoaderInterface
     */
    private $companyLoader;

    /**
     * @var DisplayFactory
     */
    private $displayFactory;

    /**
     * BrowserFactory constructor.
     *
     * @param \BrowserDetector\Loader\LoaderInterface $companyLoader
     * @param \UaResult\Device\DisplayFactory         $displayFactory
     */
    public function __construct(LoaderInterface $companyLoader, DisplayFactory $displayFactory)
    {
        $this->companyLoader  = $companyLoader;
        $this->displayFactory = $displayFactory;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Device\DeviceInterface
     */
    public function fromArray(LoggerInterface $logger, array $data): DeviceInterface
    {
        $deviceName      = isset($data['deviceName']) ? (string) $data['deviceName'] : null;
        $marketingName   = isset($data['marketingName']) ? (string) $data['marketingName'] : null;
        $dualOrientation = isset($data['dualOrientation']) ? (bool) $data['dualOrientation'] : false;

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = (new TypeLoader())->load((string) $data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = $this->companyLoader->load((string) $data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $brand = null;
        if (isset($data['brand'])) {
            try {
                $brand = $this->companyLoader->load((string) $data['brand']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $display = null;
        if (isset($data['display'])) {
            try {
                $display = $this->displayFactory->fromArray($logger, $data['display']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation);
    }
}
