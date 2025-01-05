<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Browser;

use BrowserDetector\Version\VersionInterface;
use Override;
use UaBrowserType\TypeInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Browser implements BrowserInterface
{
    /** @throws void */
    public function __construct(
        private readonly string | null $name,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
        private TypeInterface $type,
        private readonly int | null $bits = null,
        private readonly string | null $modus = null,
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
        $this->version      = clone $this->version;
        $this->type         = clone $this->type;
        $this->manufacturer = clone $this->manufacturer;
    }

    /**
     * gets the name of the browser
     *
     * @throws void
     */
    #[Override]
    public function getName(): string | null
    {
        return $this->name;
    }

    /** @throws void */
    #[Override]
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    #[Override]
    public function getModus(): string | null
    {
        return $this->modus;
    }

    /** @throws void */
    #[Override]
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /** @throws void */
    #[Override]
    public function getBits(): int | null
    {
        return $this->bits;
    }

    /** @throws void */
    #[Override]
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return array{name: string|null, modus: string|null, version: string|null, manufacturer: string, bits: int|null, type: string}
     *
     * @throws UnexpectedValueException
     */
    #[Override]
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
