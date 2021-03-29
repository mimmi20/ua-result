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

final class Result implements ResultInterface
{
    /** @var array<string> */
    private array $headers = [];

    private DeviceInterface $device;

    private BrowserInterface $browser;

    private OsInterface $os;

    private EngineInterface $engine;

    /**
     * the class constructor
     *
     * @param string[] $headers
     */
    public function __construct(
        array $headers,
        DeviceInterface $device,
        OsInterface $os,
        BrowserInterface $browser,
        EngineInterface $engine
    ) {
        $this->headers = $headers;
        $this->device  = $device;
        $this->os      = $os;
        $this->browser = $browser;
        $this->engine  = $engine;
    }

    /**
     * clones the actual object
     *
     * @return Result
     */
    public function __clone()
    {
        $this->device  = clone $this->device;
        $this->os      = clone $this->os;
        $this->browser = clone $this->browser;
        $this->engine  = clone $this->engine;
    }

    public function getBrowser(): BrowserInterface
    {
        return $this->browser;
    }

    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    public function getEngine(): EngineInterface
    {
        return $this->engine;
    }

    public function getOs(): OsInterface
    {
        return $this->os;
    }

    /**
     * @return array<string>
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
