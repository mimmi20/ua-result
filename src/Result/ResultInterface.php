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

namespace UaResult\Result;

use UaResult\Browser\BrowserInterface;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\EngineInterface;
use UaResult\Os\OsInterface;
use UnexpectedValueException;

interface ResultInterface
{
    public function getBrowser(): BrowserInterface;

    public function getDevice(): DeviceInterface;

    public function getEngine(): EngineInterface;

    public function getOs(): OsInterface;

    /**
     * @return array<string>
     */
    public function getHeaders(): array;

    /**
     * @return array<string, array<array<string, bool|float|int|null>|int|string|null>>
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;
}
