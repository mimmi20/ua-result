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

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;

final class Os implements OsInterface
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
     * @param string|null                               $name
     * @param string|null                               $marketingName
     * @param \UaResult\Company\CompanyInterface        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface $version
     * @param int|null                                  $bits
     */
    public function __construct(
        ?string $name,
        ?string $marketingName,
        CompanyInterface $manufacturer,
        VersionInterface $version,
        ?int $bits
    ) {
        $this->name          = $name;
        $this->marketingName = $marketingName;
        $this->manufacturer  = $manufacturer;
        $this->version       = $version;
        $this->bits          = $bits;
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
