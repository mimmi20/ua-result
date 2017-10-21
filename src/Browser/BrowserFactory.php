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
namespace UaResult\Browser;

use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use UaBrowserType\TypeLoader;
use UaResult\Company\CompanyLoader;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class BrowserFactory
{
    /**
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface          $logger
     * @param (string|int)[]                    $data
     *
     * @return \UaResult\Browser\BrowserInterface
     */
    public static function fromArray(CacheItemPoolInterface $cache, LoggerInterface $logger, array $data): BrowserInterface
    {
        $name  = isset($data['name']) ? $data['name'] : null;
        $modus = isset($data['modus']) ? $data['modus'] : null;
        $bits  = isset($data['bits']) ? (int) $data['bits'] : null;

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = TypeLoader::getInstance()->load($data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        $version = null;
        if (isset($data['version'])) {
            $version = VersionFactory::set($data['version']);
        }

        $manufacturer = null;
        if (isset($data['manufacturer'])) {
            try {
                $manufacturer = CompanyLoader::getInstance($cache)->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Browser($name, $manufacturer, $version, $type, $bits, $modus);
    }
}
