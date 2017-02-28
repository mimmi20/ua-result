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

use BrowserDetector\Version\Version;
use UaBrowserType\Type;
use UaBrowserType\TypeInterface;
use UaResult\Company\Company;

/**
 * base class for all browsers to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Browser implements BrowserInterface
{
    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $modus = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

    /**
     * @var bool|null
     */
    private $pdfSupport = null;

    /**
     * @var bool|null
     */
    private $rssSupport = null;

    /**
     * @var int|null
     */
    private $bits = null;

    /**
     * @var \UaBrowserType\TypeInterface|null
     */
    private $type = null;

    /**
     * @param string                                $name
     * @param \UaResult\Company\Company|null        $manufacturer
     * @param \BrowserDetector\Version\Version|null $version
     * @param \UaBrowserType\TypeInterface|null     $type
     * @param int|null                              $bits
     * @param bool                                  $pdfSupport
     * @param bool                                  $rssSupport
     * @param string|null                           $modus
     */
    public function __construct(
        $name,
        Company $manufacturer = null,
        Version $version = null,
        TypeInterface $type = null,
        $bits = null,
        $pdfSupport = false,
        $rssSupport = false,
        $modus = null
    ) {
        $this->name       = $name;
        $this->bits       = $bits;
        $this->pdfSupport = $pdfSupport;
        $this->rssSupport = $rssSupport;
        $this->modus      = $modus;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $type) {
            $this->type = new Type('unknown');
        } else {
            $this->type = $type;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('Unknown', null);
        } else {
            $this->manufacturer = $manufacturer;
        }
    }

    /**
     * gets the name of the browser
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getModus()
    {
        return $this->modus;
    }

    /**
     * @return bool|null
     */
    public function getPdfSupport()
    {
        return $this->pdfSupport;
    }

    /**
     * @return bool|null
     */
    public function getRssSupport()
    {
        return $this->rssSupport;
    }

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return int|null
     */
    public function getBits()
    {
        return $this->bits;
    }

    /**
     * @return \UaBrowserType\TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'         => $this->name,
            'modus'        => $this->modus,
            'version'      => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
            'pdfSupport'   => $this->pdfSupport,
            'rssSupport'   => $this->rssSupport,
            'bits'         => $this->bits,
            'type'         => $this->type->getType(),
        ];
    }
}
