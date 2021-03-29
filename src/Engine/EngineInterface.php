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

interface EngineInterface
{
    public function getManufacturer(): CompanyInterface;

    public function getName(): ?string;

    public function getVersion(): VersionInterface;

    /**
     * @return array<string, string|null>
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;
}
