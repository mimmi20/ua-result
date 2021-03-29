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

namespace UaResult\Browser;

use BrowserDetector\Version\VersionInterface;
use UaBrowserType\TypeInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Browser implements BrowserInterface
{
    private ?string $name = null;

    private ?string $modus = null;

    private VersionInterface $version;

    private CompanyInterface $manufacturer;

    private ?int $bits = null;

    private TypeInterface $type;

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
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    public function getModus(): ?string
    {
        return $this->modus;
    }

    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    public function getBits(): ?int
    {
        return $this->bits;
    }

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
