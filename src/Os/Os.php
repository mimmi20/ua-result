<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2023, Thomas Mueller <mimmi20@live.de>
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
    /** @throws void */
    public function __construct(
        private readonly string | null $name,
        private readonly string | null $marketingName,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
        private readonly int | null $bits = null,
    ) {
        // nothing to do
    }

    /**
     * clones the actual object
     *
     * @return void
     *
     * @throws void
     */
    public function __clone()
    {
        $this->manufacturer = clone $this->manufacturer;
        $this->version      = clone $this->version;
    }

    /** @throws void */
    public function getBits(): int | null
    {
        return $this->bits;
    }

    /** @throws void */
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    public function getName(): string | null
    {
        return $this->name;
    }

    /** @throws void */
    public function getMarketingName(): string | null
    {
        return $this->marketingName;
    }

    /** @throws void */
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
