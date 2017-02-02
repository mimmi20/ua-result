<?php
/**
 * Copyright (c) 2015, 2016, Thomas Mueller <mimmi20@live.de>
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
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/ua-result
 */

namespace UaResult\Result;

use UaResult\Browser\Browser;
use UaResult\Browser\BrowserInterface;
use UaResult\Device\Device;
use UaResult\Device\DeviceInterface;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineInterface;
use UaResult\Os\Os;
use UaResult\Os\OsInterface;
use Wurfl\Request\GenericRequest;

/**
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Result implements ResultInterface
{
    /**
     * @var \Wurfl\Request\GenericRequest|null
     */
    private $request = null;

    /**
     * @var \UaResult\Device\DeviceInterface|null
     */
    private $device = null;

    /**
     * @var \UaResult\Browser\BrowserInterface|null
     */
    private $browser = null;

    /**
     * @var \UaResult\Os\OsInterface|null
     */
    private $os = null;

    /**
     * @var \UaResult\Engine\EngineInterface|null
     */
    private $engine = null;

    /**
     * the class constructor
     *
     * @param \Wurfl\Request\GenericRequest      $request
     * @param \UaResult\Device\DeviceInterface   $device
     * @param \UaResult\Os\OsInterface           $os
     * @param \UaResult\Browser\BrowserInterface $browser
     * @param \UaResult\Engine\EngineInterface   $engine
     */
    public function __construct(
        GenericRequest $request,
        DeviceInterface $device = null,
        OsInterface $os = null,
        BrowserInterface $browser = null,
        EngineInterface $engine = null
    ) {
        $this->request  = $request;

        if (null === $device) {
            $this->device = new Device(null, null);
        } else {
            $this->device = $device;
        }

        if (null === $os) {
            $this->os = new Os('unknown', 'unknown');
        } else {
            $this->os = $os;
        }

        if (null === $browser) {
            $this->browser = new Browser('unknown');
        } else {
            $this->browser = $browser;
        }

        if (null === $engine) {
            $this->engine = new Engine('unknown');
        } else {
            $this->engine = $engine;
        }
    }

    /**
     * @return \UaResult\Browser\BrowserInterface|null
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @return \UaResult\Device\DeviceInterface|null
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @return \UaResult\Engine\EngineInterface|null
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @return \UaResult\Os\OsInterface|null
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @return \Wurfl\Request\GenericRequest|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'request'      => $this->request->toArray(),
            'device'       => $this->device->toArray(),
            'browser'      => $this->browser->toArray(),
            'os'           => $this->os->toArray(),
            'engine'       => $this->engine->toArray(),
        ];
    }
}
