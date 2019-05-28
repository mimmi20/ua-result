<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Os;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;

interface OsInterface
{
    /**
     * @return int|null
     */
    public function getBits(): ?int;

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return string|null
     */
    public function getMarketingName(): ?string;

    /**
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function getVersion(): VersionInterface;

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function toArray(): array;
}
