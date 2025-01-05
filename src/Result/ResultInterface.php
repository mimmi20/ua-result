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
     * @return array<string, string>
     *
     * @throws void
     */
    public function getHeaders(): array;

    /**
     * @return array{headers: array<string, string>, device: array{deviceName: string|null, marketingName: string|null, manufacturer: string, brand: string, type: string, display: array{width: int|null, height: int|null, touch: bool|null, size: float|null}}, browser: array{name: string|null, modus: string|null, version: string|null, manufacturer: string, bits: int|null, type: string}, os: array{name: string|null, marketingName: string|null, version: string|null, manufacturer: string, bits: int|null}, engine: array{name: string|null, version: string|null, manufacturer: string}}
     *
     * @throws UnexpectedValueException
     */
    public function toArray(): array;
}
