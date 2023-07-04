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

namespace UaResult\Engine;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

final class Engine implements EngineInterface
{
    /** @throws void */
    public function __construct(
        private string | null $name,
        private CompanyInterface $manufacturer,
        private VersionInterface $version,
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
        $this->manufacturer = clone $this->manufacturer;
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
