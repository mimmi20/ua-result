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

interface BrowserInterface
{
    /**
     * gets the name of the browser
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface;

    /**
     * @return string|null
     */
    public function getModus(): ?string;

    /**
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function getVersion(): VersionInterface;

    /**
     * @return int|null
     */
    public function getBits(): ?int;

    /**
     * @return \UaBrowserType\TypeInterface
     */
    public function getType(): TypeInterface;

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function toArray(): array;
}
