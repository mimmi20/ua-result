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

namespace UaResult\Result;

use UaResult\Browser\BrowserInterface;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\EngineInterface;
use UaResult\Os\OsInterface;
use UnexpectedValueException;

interface ResultInterface
{
    /** @throws void */
    public function getBrowser(): BrowserInterface;

    /** @throws void */
    public function getDevice(): DeviceInterface;

    /** @throws void */
    public function getEngine(): EngineInterface;

    /** @throws void */
    public function getOs(): OsInterface;

    /**
     * @return array<string>
     *
     * @throws void
     */
    public function getHeaders(): array;

    /**
     * @return array<string, array<array<string, bool|float|int|null>|int|string|null>>
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;
}
