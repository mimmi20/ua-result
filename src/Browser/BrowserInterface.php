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
use UaBrowserType\TypeInterface;
use UaResult\Bits\Bits;
use UaResult\Company\CompanyInterface;
use UnexpectedValueException;

interface BrowserInterface
{
    /**
     * gets the name of the browser
     *
     * @throws void
     */
    public function getName(): string | null;

    /** @throws void */
    public function getManufacturer(): CompanyInterface;

    /** @throws void */
    public function getModus(): string | null;

    /** @throws void */
    public function getVersion(): VersionInterface;

    /** @throws void */
    public function getBits(): Bits;

    /** @throws void */
    public function getType(): TypeInterface;

    /**
     * @return array{name: string|null, modus: string|null, version: string|null, manufacturer: string, bits: Bits, type: string}
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;

    /** @throws void */
    public function withVersion(VersionInterface $version): self;
}
