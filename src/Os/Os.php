<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Os;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Os implements OsInterface
{
    private ?string $name = null;

    private ?string $marketingName = null;

    private VersionInterface $version;

    private CompanyInterface $manufacturer;

    private ?int $bits = null;

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

    public function getBits(): ?int
    {
        return $this->bits;
    }

    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMarketingName(): ?string
    {
        return $this->marketingName;
    }

    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @return array<string, int|string|null>
     *
     * @throws UnexpectedValueException
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
