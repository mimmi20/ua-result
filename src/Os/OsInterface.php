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
use UaData\CompanyInterface;
use UaResult\Bits\Bits;
use UnexpectedValueException;

interface OsInterface
{
    /** @throws void */
    public function getBits(): Bits;

    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getName(): string | null;

    /** @throws void */
    public function getMarketingName(): string | null;

    /** @throws void */
    public function getVersion(): VersionInterface;

    /**
     * @return array{name: string|null, marketingName: string|null, version: string|null, manufacturer: string, bits: Bits}
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;

    /** @throws void */
    public function withVersion(VersionInterface $version): self;
}
