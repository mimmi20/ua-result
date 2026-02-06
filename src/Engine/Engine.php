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

namespace UaResult\Engine;

use BrowserDetector\Version\VersionInterface;
use Override;
use UaData\CompanyInterface;
use UnexpectedValueException;

final class Engine implements EngineInterface
{
    /** @throws void */
    public function __construct(
        private readonly string | null $name,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
    ) {
        // nothing to do
    }

    /**
     * clones the actual object
     *
     * @throws void
     */
    public function __clone()
    {
        $this->version      = clone $this->version;
        $this->manufacturer = clone $this->manufacturer;
    }

    /** @throws void */
    #[Override]
    public function withVersion(VersionInterface $version): EngineInterface
    {
        $new          = clone $this;
        $new->version = $version;

        return $new;
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
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @return array{name: string|null, version: string|null, manufacturer: string}
     *
     * @throws UnexpectedValueException
     */
    #[Override]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getKey(),
        ];
    }
}
