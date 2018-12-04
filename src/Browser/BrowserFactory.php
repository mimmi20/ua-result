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

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\VersionFactory;
use Psr\Log\LoggerInterface;
use UaBrowserType\TypeLoader;

class BrowserFactory
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
     * @return \UaResult\Browser\BrowserInterface
     */
    public function fromArray(LoggerInterface $logger, array $data): BrowserInterface
    {
        $name  = array_key_exists('name', $data) ? $data['name'] : null;
        $modus = array_key_exists('modus', $data) ? $data['modus'] : null;
        $bits  = array_key_exists('bits', $data) ? $data['bits'] : null;

        $type = null;
        if (array_key_exists('type', $data)) {
            try {
                $type = (new TypeLoader())->load($data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

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

        return new Browser($name, $manufacturer, $version, $type, $bits, $modus);
    }
}
