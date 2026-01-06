<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2026, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Os;

use BrowserDetector\Version\VersionInterface;
use Override;
use UaData\CompanyInterface;
use UaResult\Bits\Bits;
use UnexpectedValueException;

final class Os implements OsInterface
{
    /** @throws void */
    public function __construct(
        private readonly string | null $name,
        private readonly string | null $marketingName,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
        private readonly Bits $bits = Bits::unknown,
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
    #[Override]
    public function withVersion(VersionInterface $version): OsInterface
    {
        $new          = clone $this;
        $new->version = $version;

        return $new;
    }

    /** @throws void */
    #[Override]
    public function getBits(): Bits
    {
        return $this->bits;
    }

    /** @throws void */
    #[Override]
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    #[Override]
    public function getName(): string | null
    {
        return $this->name;
    }

    /** @throws void */
    #[Override]
    public function getMarketingName(): string | null
    {
        return $this->marketingName;
    }

    /** @throws void */
    #[Override]
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @return array{name: string|null, marketingName: string|null, version: string|null, manufacturer: string, bits: Bits}
     *
     * @throws UnexpectedValueException
     */
    #[Override]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'marketingName' => $this->marketingName,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getKey(),
            'bits' => $this->bits,
        ];
    }
}
