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

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use UaResult\Company\Company;
use UaResult\Company\CompanyInterface;

class Os implements OsInterface
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $marketingName;

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
     * @param string|null                                    $name
     * @param string|null                                    $marketingName
     * @param \UaResult\Company\CompanyInterface|null        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface|null $version
     * @param int|null                                       $bits
     */
    public function __construct(
        ?string $name = null,
        ?string $marketingName = null,
        ?CompanyInterface $manufacturer = null,
        ?VersionInterface $version = null,
        ?int $bits = null
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

    /**
     * clones the actual object
     *
     * @return Os
     */
    public function __clone()
    {
        $this->manufacturer = clone $this->manufacturer;
        $this->version      = clone $this->version;
    }

    /**
     * @return int|null
     */
    public function getBits(): ?int
    {
        return $this->bits;
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getMarketingName(): ?string
    {
        return $this->marketingName;
    }

    /**
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'marketingName' => $this->marketingName,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
            'bits' => $this->bits,
        ];
    }
}
