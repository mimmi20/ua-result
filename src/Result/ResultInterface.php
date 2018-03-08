<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2018, Thomas Mueller <mimmi20@live.de>
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

interface ResultInterface
{
    /**
     * @return \UaResult\Browser\BrowserInterface
     */
    public function getBrowser(): BrowserInterface;

    /**
     * @return \UaResult\Device\DeviceInterface
     */
    public function getDevice(): DeviceInterface;

    /**
     * @return \UaResult\Engine\EngineInterface
     */
    public function getEngine(): EngineInterface;

    /**
     * @return \UaResult\Os\OsInterface
     */
    public function getOs(): OsInterface;

    /**
     * @return string[]
     */
    public function getHeaders(): array;

    /**
     * @return array[]
     */
    public function toArray(): array;
}
