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
use UaData\CompanyInterface;
use UnexpectedValueException;

interface EngineInterface
{
    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getName(): string | null;

    /** @throws void */
    public function getVersion(): VersionInterface;

    /**
     * @return array{name: string|null, version: string|null, manufacturer: string}
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;

    /** @throws void */
    public function withVersion(VersionInterface $version): self;
}
