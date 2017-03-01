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
     * @return \UaResult\Browser\BrowserInterface
     */
    public function getBrowser();

    /**
     * @return \UaResult\Device\DeviceInterface
     */
    public function getDevice();

    /**
     * @return \UaResult\Engine\EngineInterface
     */
    public function getEngine();

    /**
     * @return \UaResult\Os\OsInterface
     */
    public function getOs();

    /**
     * @return array
     */
    public function toArray();
}
