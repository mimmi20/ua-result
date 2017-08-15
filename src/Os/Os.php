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

use BrowserDetector\Version\Version;
use UaResult\Company\Company;

/**
 * base class for all rendering platforms/operating systems to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Os implements OsInterface
{
    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $marketingName = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

    /**
     * @var int|null
     */
    private $bits = null;

    /**
     * @param string                                $name
     * @param string                                $marketingName
     * @param \UaResult\Company\Company|null        $manufacturer
     * @param \BrowserDetector\Version\Version|null $version
     * @param int|null                              $bits
     */
    public function __construct(
        $name,
        $marketingName,
        Company $manufacturer = null,
        Version $version = null,
        int $bits = null
    ) {
        $this->name          = $name;
        $this->marketingName = $marketingName;
        $this->bits          = $bits;

        if (null === $manufacturer) {
            $this->manufacturer = new Company('Unknown', null);
        } else {
            $this->manufacturer = $manufacturer;
        }

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }
    }

    public function __clone()
    {
        $this->manufacturer = clone $this->manufacturer;
        $this->version      = clone $this->version;
    }

    /**
     * @return int|null
     */
    public function getBits()
    {
        return $this->bits;
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
     * @return string|null
     */
    public function getMarketingName()
    {
        return $this->marketingName;
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
            'name'          => $this->name,
            'marketingName' => $this->marketingName,
            'version'       => $this->version->getVersion(),
            'manufacturer'  => $this->manufacturer->getType(),
            'bits'          => $this->bits,
        ];
    }
}
