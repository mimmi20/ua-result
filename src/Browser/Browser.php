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

namespace UaResult\Browser;

use BrowserDetector\Version\VersionInterface;
use UaBrowserType\TypeInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Browser implements BrowserInterface
{
    /** @throws void */
    public function __construct(
        private string | null $name,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
        private TypeInterface $type,
        private int | null $bits = null,
        private string | null $modus = null,
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
    public function getName(): string | null
    {
        return $this->name;
    }

    /** @throws void */
    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    /** @throws void */
    public function getModus(): string | null
    {
        return $this->modus;
    }

    /** @throws void */
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /** @throws void */
    public function getBits(): int | null
    {
        return $this->bits;
    }

    /** @throws void */
    public function getType(): TypeInterface
    {
        return $this->type;
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
            'modus' => $this->modus,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
            'bits' => $this->bits,
            'type' => $this->type->getType(),
        ];
    }
}
