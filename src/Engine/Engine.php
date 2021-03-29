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

namespace UaResult\Engine;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Engine implements EngineInterface
{
    private ?string $name = null;

    private VersionInterface $version;

    private CompanyInterface $manufacturer;

    public function __construct(
        ?string $name,
        CompanyInterface $manufacturer,
        VersionInterface $version
    ) {
        $this->name         = $name;
        $this->manufacturer = $manufacturer;
        $this->version      = $version;
    }

    /**
     * clones the actual object
     *
     * @return Engine
     */
    public function __clone()
    {
        $this->version      = clone $this->version;
        $this->manufacturer = clone $this->manufacturer;
    }

    public function getManufacturer(): CompanyInterface
    {
        return $this->manufacturer;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @return array<string, string|null>
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
        ];
    }
}
