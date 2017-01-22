<?php
/**
 * Copyright (c) 2012-2016, Thomas Mueller <mimmi20@live.de>
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
 * FITNESS FOR A PARTICULAR PURPResultE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult\Result;

use UaResult\Browser\BrowserFactory;
use UaResult\Device\DeviceFactory;
use UaResult\Engine\EngineFactory;
use UaResult\Os\OsFactory;
use Wurfl\Request\GenericRequestFactory;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class ResultFactory
{
    /**
     * @param array $data
     *
     * @return \UaResult\Result\Result
     */
    public function fromArray(array $data)
    {
        $capabilities = isset($data['capabilities']) ? $data['capabilities'] : [];
        $wurflKey     = isset($data['wurflKey']) ? $data['wurflKey'] : null;

        if (isset($data['request'])) {
            $request = (new GenericRequestFactory())->fromArray((array) $data['request']);
        } else {
            $request = (new GenericRequestFactory())->createRequestForUserAgent('');
        }

        if (isset($data['device'])) {
            $device = (new DeviceFactory())->fromArray((array) $data['device']);
        } else {
            $device = null;
        }

        if (isset($data['browser'])) {
            $browser = (new BrowserFactory())->fromArray((array) $data['browser']);
        } else {
            $browser = null;
        }

        if (isset($data['os'])) {
            $os = (new OsFactory())->fromArray((array) $data['os']);
        } else {
            $os = null;
        }

        if (isset($data['engine'])) {
            $engine = (new EngineFactory())->fromArray((array) $data['engine']);
        } else {
            $engine = null;
        }

        return new Result($request, $device, $os, $browser, $engine, (array) $capabilities, $wurflKey);
    }

    /**
     * @param string $json
     *
     * @return \UaResult\Result\Result
     */
    public function fromJson($json)
    {
        return $this->fromArray((array) json_decode($json));
    }
}
