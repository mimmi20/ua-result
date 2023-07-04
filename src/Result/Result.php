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

final class Result implements ResultInterface
{
    /**
     * the class constructor
     *
     * @param array<string> $headers
     *
     * @throws void
     */
    public function __construct(
        private array $headers,
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
    public function getBrowser(): BrowserInterface
    {
        return $this->browser;
    }

    /** @throws void */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /** @throws void */
    public function getEngine(): EngineInterface
    {
        return $this->engine;
    }

    /** @throws void */
    public function getOs(): OsInterface
    {
        return $this->os;
    }

    /**
     * @return array<string>
     *
     * @throws void
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array<string, array<array<string, bool|float|int|null>|int|string|null>>
     *
     * @throws UnexpectedValueException
     */
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
