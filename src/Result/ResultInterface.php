<?php
/**
 * Copyright (c) 2012-2015, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult\Result;

use UaMatcher\Version\VersionInterface;
use Wurfl\WurflConstants;
use Psr\Log\LoggerInterface;

/**
 * BrowserDetector.ini parsing class with caching and update capabilities
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface ResultInterface extends \Serializable
{
    /**
     * @return \UaMatcher\Browser\BrowserInterface
     */
    public function getBrowser();

    /**
     * @return \UaMatcher\Device\DeviceInterface
     */
    public function getDevice();

    /**
     * @return \UaMatcher\Engine\EngineInterface
     */
    public function getEngine();

    /**
     * @return \UaMatcher\Os\OsInterface
     */
    public function getOs();

    /**
     * @return string
     */
    public function getWurflKey();

    /**
     * Returns the values of all capabilities for the current device
     *
     * @return string[] All Capability values
     */
    public function getCapabilities();

    /**
     * Returns the value of a given capability name for the current device
     *
     * @param string $capabilityName must be a valid capability name
     *
     * @return string|VersionInterface Capability value
     * @throws \InvalidArgumentException
     */
    public function getCapability($capabilityName);
}
