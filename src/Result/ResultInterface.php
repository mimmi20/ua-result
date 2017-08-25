<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
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

/**
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface ResultInterface
{
    /**
     * @return \UaResult\Browser\BrowserInterface|null
     */
    public function getBrowser(): ?BrowserInterface;

    /**
     * @return \UaResult\Device\DeviceInterface|null
     */
    public function getDevice(): ?DeviceInterface;

    /**
     * @return \UaResult\Engine\EngineInterface|null
     */
    public function getEngine(): ?EngineInterface;

    /**
     * @return \UaResult\Os\OsInterface|null
     */
    public function getOs(): ?OsInterface;

    /**
     * @return string[]
     */
    public function getHeaders(): array;

    /**
     * @return string[]
     */
    public function toArray(): array;
}
