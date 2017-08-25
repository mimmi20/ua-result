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
namespace UaResult\Os;

use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
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
class OsFactory
{
    /**
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface          $logger
     * @param array                             $data
     *
     * @return \UaResult\Os\OsInterface
     */
    public function fromArray(CacheItemPoolInterface $cache, LoggerInterface $logger, array $data): OsInterface
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
                $manufacturer = (new CompanyLoader($cache))->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Os($name, $marketingName, $manufacturer, $version, $bits);
    }
}
