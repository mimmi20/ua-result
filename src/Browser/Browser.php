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
use BrowserDetector\Version\VersionInterface;
use UaBrowserType\Type;
use UaBrowserType\TypeInterface;
use UaResult\Company\Company;
use UaResult\Company\CompanyInterface;

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
     * @var \BrowserDetector\Version\VersionInterface|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\CompanyInterface|null
     */
    private $manufacturer = null;

    /**
     * @var int|null
     */
    private $bits = null;

    /**
     * @var \UaBrowserType\TypeInterface|null
     */
    private $type = null;

    /**
     * @param string|null                                    $name
     * @param \UaResult\Company\CompanyInterface|null        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface|null $version
     * @param \UaBrowserType\TypeInterface|null              $type
     * @param int|null                                       $bits
     * @param string|null                                    $modus
     */
    public function __construct(
        ?string $name = null,
        ?CompanyInterface $manufacturer = null,
        ?VersionInterface $version = null,
        ?TypeInterface $type = null,
        ?int $bits = null,
        ?string $modus = null
    ) {
        $this->name  = $name;
        $this->bits  = $bits;
        $this->modus = $modus;

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

    public function __clone()
    {
        $this->version      = clone $this->version;
        $this->type         = clone $this->type;
        $this->manufacturer = clone $this->manufacturer;
    }

    /**
     * gets the name of the browser
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return \UaResult\Company\CompanyInterface|null
     */
    public function getManufacturer(): ?CompanyInterface
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getModus(): ?string
    {
        return $this->modus;
    }

    /**
     * @return \BrowserDetector\Version\VersionInterface|null
     */
    public function getVersion(): ?VersionInterface
    {
        return $this->version;
    }

    /**
     * @return int|null
     */
    public function getBits(): ?int
    {
        return $this->bits;
    }

    /**
     * @return \UaBrowserType\TypeInterface|null
     */
    public function getType(): ?TypeInterface
    {
        return $this->type;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'modus'        => $this->modus,
            'version'      => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
            'bits'         => $this->bits,
            'type'         => $this->type->getType(),
        ];
    }
}
