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
        $deviceName      = array_key_exists('deviceName', $data) ? $data['deviceName'] : null;
        $marketingName   = array_key_exists('marketingName', $data) ? $data['marketingName'] : null;
        $dualOrientation = array_key_exists('dualOrientation', $data) ? $data['dualOrientation'] : false;

        $type = null;
        if (array_key_exists('type', $data)) {
            try {
                $type = (new TypeLoader())->load($data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $manufacturer = null;
        if (array_key_exists('manufacturer', $data)) {
            try {
                $manufacturer = $this->companyLoader->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $brand = null;
        if (array_key_exists('brand', $data)) {
            try {
                $brand = $this->companyLoader->load($data['brand']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $display = null;
        if (array_key_exists('display', $data)) {
            try {
                $display = $this->displayFactory->fromArray($logger, (array) $data['display']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Device($deviceName, $marketingName, $manufacturer, $brand, $type, $display, $dualOrientation);
    }
}
