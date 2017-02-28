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
namespace UaResult\Engine;

use BrowserDetector\Version\Version;
use UaResult\Company\Company;

/**
 * base class for all rendering engines to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Engine implements EngineInterface
{
    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

    /**
     * @param string                           $name
     * @param \UaResult\Company\Company        $manufacturer
     * @param \BrowserDetector\Version\Version $version
     */
    public function __construct($name, Company $manufacturer = null, Version $version = null)
    {
        $this->name = $name;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('Unknown', null);
        } else {
            $this->manufacturer = $manufacturer;
        }
    }

    /**
     * @return \UaResult\Company\Company|null
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'         => $this->name,
            'version'      => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
        ];
    }
}
