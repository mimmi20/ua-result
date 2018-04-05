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
namespace UaResult\Browser;

use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\LoggerInterface;
use UaBrowserType\TypeLoader;
use UaResult\Company\CompanyLoader;

class BrowserFactory
{
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Browser\BrowserInterface
     */
    public static function fromArray(LoggerInterface $logger, array $data): BrowserInterface
    {
        $name  = isset($data['name']) ? (string) $data['name'] : null;
        $modus = isset($data['modus']) ? (string) $data['modus'] : null;
        $bits  = isset($data['bits']) ? (int) $data['bits'] : null;

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = (new TypeLoader())->load((string) $data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $version = null;
        if (isset($data['version'])) {
            $version = (new VersionFactory())->set((string) $data['version']);
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = CompanyLoader::getInstance()->load((string) $data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Browser($name, $manufacturer, $version, $type, $bits, $modus);
    }
}
