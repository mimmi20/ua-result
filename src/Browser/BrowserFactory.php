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
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
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

namespace UaResult\Browser;

use BrowserDetector\Version\VersionFactory;
use UaBrowserType\TypeFactory;
use UaResult\Engine\EngineFactory;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class BrowserFactory
{
    /**
     * @param array $data
     *
     * @return \UaResult\Browser\Browser
     */
    public function fromArray(array $data)
    {
        $name         = isset($data['name']) ? $data['name'] : null;
        $modus        = isset($data['modus']) ? $data['modus'] : null;
        $manufacturer = isset($data['manufacturer']) ? $data['manufacturer'] : null;
        $brand        = isset($data['brand']) ? $data['brand'] : null;
        $pdfSupport   = isset($data['pdfSupport']) ? $data['pdfSupport'] : null;
        $rssSupport   = isset($data['rssSupport']) ? $data['rssSupport'] : null;
        $bits         = isset($data['bits']) ? $data['bits'] : null;

        if (isset($data['type'])) {
            $type = (new TypeFactory())->fromArray((array) $data['type']);
        } else {
            $type = null;
        }

        if (isset($data['version'])) {
            $version = (new VersionFactory())->fromArray((array) $data['version']);
        } else {
            $version = null;
        }

        if (isset($data['engine'])) {
            $engine = (new EngineFactory())->fromArray((array) $data['engine']);
        } else {
            $engine = null;
        }

        return new Browser($name, $manufacturer, $brand, $version, $engine, $type, $bits, $pdfSupport, $rssSupport, $modus);
    }

    /**
     * @param string $json
     *
     * @return \UaResult\Browser\Browser
     */
    public function fromJson($json)
    {
        return $this->fromArray((array) json_decode($json));
    }
}
