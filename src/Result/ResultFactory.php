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
namespace UaResult\Result;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use UaResult\Browser\BrowserFactory;
use UaResult\Device\DeviceFactory;
use UaResult\Engine\EngineFactory;
use UaResult\Os\OsFactory;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class ResultFactory
{
    /**
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     * @param \Psr\Log\LoggerInterface          $logger
     * @param array                             $data
     *
     * @return \UaResult\Result\Result
     */
    public function fromArray(CacheItemPoolInterface $cache, LoggerInterface $logger, array $data): Result
    {
        $headers = [];
        if (isset($data['headers'])) {
            $headers = $data['headers'];
        }

        $device = null;
        if (isset($data['device'])) {
            $device = (new DeviceFactory())->fromArray($cache, $logger, (array) $data['device']);
        }

        $browser = null;
        if (isset($data['browser'])) {
            $browser = (new BrowserFactory())->fromArray($cache, $logger, (array) $data['browser']);
        }

        $os = null;
        if (isset($data['os'])) {
            $os = (new OsFactory())->fromArray($cache, $logger, (array) $data['os']);
        }

        $engine = null;
        if (isset($data['engine'])) {
            $engine = (new EngineFactory())->fromArray($cache, $logger, (array) $data['engine']);
        }

        return new Result($headers, $device, $os, $browser, $engine);
    }
}
