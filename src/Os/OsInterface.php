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

namespace UaResult\Os;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

interface OsInterface
{
    /** @throws void */
    public function getBits(): int | null;

    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getName(): string | null;

    /** @throws void */
    public function getMarketingName(): string | null;

    /** @throws void */
    public function getVersion(): VersionInterface;

    /**
     * @return array<string, int|string|null>
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;
}
