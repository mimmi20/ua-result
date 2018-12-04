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

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\LoggerInterface;

class OsFactory
{
    /**
     * @var \BrowserDetector\Loader\LoaderInterface
     */
    private $companyLoader;

    /**
     * BrowserFactory constructor.
     *
     * @param \BrowserDetector\Loader\LoaderInterface $companyLoader
     */
    public function __construct(LoaderInterface $companyLoader)
    {
        $this->companyLoader = $companyLoader;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Os\OsInterface
     */
    public function fromArray(LoggerInterface $logger, array $data): OsInterface
    {
        $name          = array_key_exists('name', $data) ? $data['name'] : null;
        $marketingName = array_key_exists('marketingName', $data) ? $data['marketingName'] : null;
        $bits          = array_key_exists('bits', $data) ? $data['bits'] : null;

        $version = null;
        if (array_key_exists('version', $data)) {
            $version = (new VersionFactory())->set($data['version']);
        }

        $manufacturer = null;
        if (array_key_exists('manufacturer', $data)) {
            try {
                $manufacturer = $this->companyLoader->load($data['manufacturer']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Os($name, $marketingName, $manufacturer, $version, $bits);
    }
}
