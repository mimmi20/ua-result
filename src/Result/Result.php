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
            $this->os = new Os(null, null);
        } else {
            $this->os = $os;
        }

        if (null === $browser) {
            $this->browser = new Browser(null);
        } else {
            $this->browser = $browser;
        }

        if (null === $engine) {
            $this->engine = new Engine(null);
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
