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

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use UaBrowserType\TypeInterface;
use UaBrowserType\Unknown;
use UaResult\Company\Company;
use UaResult\Company\CompanyInterface;

class Browser implements BrowserInterface
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $modus;

    /**
     * @var \BrowserDetector\Version\VersionInterface
     */
    private $version;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $manufacturer;

    /**
     * @var int|null
     */
    private $bits;

    /**
     * @var \UaBrowserType\TypeInterface
     */
    private $type;

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
            $this->type = new Unknown();
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
     * clones the actual object
     *
     * @return void
     */
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
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface
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
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function getVersion(): VersionInterface
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
     * @return \UaBrowserType\TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'modus' => $this->modus,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
            'bits' => $this->bits,
            'type' => $this->type->getType(),
        ];
    }
}
