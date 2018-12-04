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
namespace UaResult\Result;

use BrowserDetector\Loader\LoaderInterface;
use Psr\Log\LoggerInterface;
use UaResult\Browser\BrowserFactory;
use UaResult\Device\DeviceFactory;
use UaResult\Device\DisplayFactory;
use UaResult\Engine\EngineFactory;
use UaResult\Os\OsFactory;

class ResultFactory
{
    /**
     * @var \BrowserDetector\Loader\LoaderInterface
     */
    private $loader;

    /**
     * BrowserFactory constructor.
     *
     * @param \BrowserDetector\Loader\LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Result\Result
     */
    public function fromArray(LoggerInterface $logger, array $data): Result
    {
        $headers = [];
        if (array_key_exists('headers', $data)) {
            $headers = (array) $data['headers'];
        }

        $device = null;
        if (array_key_exists('device', $data)) {
            $device = (new DeviceFactory($this->loader, new DisplayFactory()))->fromArray($logger, (array) $data['device']);
        }

        $browser = null;
        if (array_key_exists('browser', $data)) {
            $browser = (new BrowserFactory($this->loader))->fromArray($logger, (array) $data['browser']);
        }

        $os = null;
        if (array_key_exists('os', $data)) {
            $os = (new OsFactory($this->loader))->fromArray($logger, (array) $data['os']);
        }

        $engine = null;
        if (array_key_exists('engine', $data)) {
            $engine = (new EngineFactory($this->loader))->fromArray($logger, (array) $data['engine']);
        }

        return new Result($headers, $device, $os, $browser, $engine);
    }
}
