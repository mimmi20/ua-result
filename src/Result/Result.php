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
namespace UaResult\Result;

use UaResult\Browser\Browser;
use UaResult\Browser\BrowserInterface;
use UaResult\Device\Device;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineInterface;
use UaResult\Os\Os;
use UaResult\Os\OsInterface;

final class Result implements ResultInterface
{
    /**
     * @var string[]
     */
    private $headers = [];

    /**
     * @var \UaResult\Device\DeviceInterface
     */
    private $device;

    /**
     * @var \UaResult\Browser\BrowserInterface
     */
    private $browser;

    /**
     * @var \UaResult\Os\OsInterface
     */
    private $os;

    /**
     * @var \UaResult\Engine\EngineInterface
     */
    private $engine;

    /**
     * the class constructor
     *
     * @param string[]                           $headers
     * @param \UaResult\Device\DeviceInterface   $device
     * @param \UaResult\Os\OsInterface           $os
     * @param \UaResult\Browser\BrowserInterface $browser
     * @param \UaResult\Engine\EngineInterface   $engine
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

    /**
     * @return \UaResult\Browser\BrowserInterface
     */
    public function getBrowser(): BrowserInterface
    {
        return $this->browser;
    }

    /**
     * @return \UaResult\Device\DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @return \UaResult\Engine\EngineInterface
     */
    public function getEngine(): EngineInterface
    {
        return $this->engine;
    }

    /**
     * @return \UaResult\Os\OsInterface
     */
    public function getOs(): OsInterface
    {
        return $this->os;
    }

    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return array[]
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
