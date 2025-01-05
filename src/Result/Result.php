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

use Override;
use UaResult\Browser\BrowserInterface;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\EngineInterface;
use UaResult\Os\OsInterface;
use UnexpectedValueException;

final class Result implements ResultInterface
{
    /**
     * the class constructor
     *
     * @param array<string, string> $headers
     *
     * @throws void
     */
    public function __construct(
        private readonly array $headers,
        private DeviceInterface $device,
        private OsInterface $os,
        private BrowserInterface $browser,
        private EngineInterface $engine,
    ) {
        // nothing to do
    }

    /**
     * clones the actual object
     *
     * @return void
     *
     * @throws void
     */
    public function __clone()
    {
        $this->device  = clone $this->device;
        $this->os      = clone $this->os;
        $this->browser = clone $this->browser;
        $this->engine  = clone $this->engine;
    }

    /** @throws void */
    #[Override]
    public function getBrowser(): BrowserInterface
    {
        return $this->browser;
    }

    /** @throws void */
    #[Override]
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /** @throws void */
    #[Override]
    public function getEngine(): EngineInterface
    {
        return $this->engine;
    }

    /** @throws void */
    #[Override]
    public function getOs(): OsInterface
    {
        return $this->os;
    }

    /**
     * @return array<string, string>
     *
     * @throws void
     */
    #[Override]
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array{headers: array<string, string>, device: array{deviceName: string|null, marketingName: string|null, manufacturer: string, brand: string, type: string, display: array{width: int|null, height: int|null, touch: bool|null, size: float|null}}, browser: array{name: string|null, modus: string|null, version: string|null, manufacturer: string, bits: int|null, type: string}, os: array{name: string|null, marketingName: string|null, version: string|null, manufacturer: string, bits: int|null}, engine: array{name: string|null, version: string|null, manufacturer: string}}
     *
     * @throws UnexpectedValueException
     */
    #[Override]
    public function toArray(): array
    {
        return [
            'headers' => $this->headers,
            'device' => $this->device->toArray(),
            'browser' => $this->browser->toArray(),
            'os' => $this->os->toArray(),
            'engine' => $this->engine->toArray(),
        ];
    }
}
