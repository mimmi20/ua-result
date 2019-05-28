<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Browser;

use BrowserDetector\Version\VersionInterface;
use UaBrowserType\TypeInterface;
use UaResult\Company\CompanyInterface;

final class Browser implements BrowserInterface
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
     * @param string|null                               $name
     * @param \UaResult\Company\CompanyInterface        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface $version
     * @param \UaBrowserType\TypeInterface              $type
     * @param int|null                                  $bits
     * @param string|null                               $modus
     */
    public function __construct(
        ?string $name,
        CompanyInterface $manufacturer,
        VersionInterface $version,
        TypeInterface $type,
        ?int $bits,
        ?string $modus
    ) {
        $this->name         = $name;
        $this->manufacturer = $manufacturer;
        $this->version      = $version;
        $this->type         = $type;
        $this->bits         = $bits;
        $this->modus        = $modus;
    }

    /**
     * clones the actual object
     *
     * @return Browser
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
     * @throws \UnexpectedValueException
     *
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
