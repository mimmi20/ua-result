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
namespace UaResult\Os;

use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\LoggerInterface;
use UaResult\Company\CompanyLoader;

class OsFactory
{
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Os\OsInterface
     */
    public function fromArray(LoggerInterface $logger, array $data): OsInterface
    {
        $name          = isset($data['name']) ? $data['name'] : null;
        $marketingName = isset($data['marketingName']) ? $data['marketingName'] : null;
        $bits          = isset($data['bits']) ? $data['bits'] : null;

        $version = null;
        if (isset($data['version'])) {
            $version = VersionFactory::set($data['version']);
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = CompanyLoader::getInstance()->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Os($name, $marketingName, $manufacturer, $version, $bits);
    }
}
