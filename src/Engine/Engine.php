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

namespace UaResult\Engine;

use BrowserDetector\Version\Version;

/**
 * base class for all rendering engines to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Engine implements EngineInterface, \Serializable
{
    /**
     * @var string the user agent to handle
     */
    private $useragent = null;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var string|null
     */
    private $manufacturer = null;

    /**
     * Class Constructor
     *
     * @param string                                $useragent    the user agent to be handled
     * @param string                                $name
     * @param \BrowserDetector\Version\Version|null $version
     * @param string|null                           $manufacturer
     */
    public function __construct($useragent, $name, Version $version = null, $manufacturer = null)
    {
        $this->useragent    = $useragent;
        $this->name         = $name;
        $this->version      = $version;
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string|null
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     *
     * @link http://php.net/manual/en/serializable.serialize.php
     *
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            [
                'useragent'    => $this->useragent,
                'name'         => $this->name,
                'version'      => $this->version,
                'manufacturer' => $this->manufacturer,
            ]
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     *
     * @link http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     *                           The string representation of the object.
     *                           </p>
     */
    public function unserialize($serialized)
    {
        $unseriliazedData = unserialize($serialized);

        $this->useragent    = $unseriliazedData['useragent'];
        $this->name         = $unseriliazedData['name'];
        $this->version      = $unseriliazedData['version'];
        $this->manufacturer = $unseriliazedData['manufacturer'];
    }
}
