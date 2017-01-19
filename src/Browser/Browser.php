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

namespace UaResult\Browser;

use BrowserDetector\Version\Version;
use UaBrowserType\TypeInterface;
use UaResult\Engine\Engine;

/**
 * base class for all browsers to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Browser implements BrowserInterface, \Serializable
{
    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $modus = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var string|null
     */
    private $manufacturer = null;

    /**
     * @var string|null
     */
    private $brand = null;

    /**
     * @var bool|null
     */
    private $pdfSupport = null;

    /**
     * @var bool|null
     */
    private $rssSupport = null;

    /**
     * @var int|null
     */
    private $bits = null;

    /**
     * @var \UaBrowserType\TypeInterface|null
     */
    private $type = null;

    /**
     * @var \UaResult\Engine\Engine
     */
    private $engine = null;

    /**
     * @param string                           $name
     * @param string                           $manufacturer
     * @param string                           $brand
     * @param \BrowserDetector\Version\Version $version
     * @param \UaResult\Engine\Engine          $engine
     * @param \UaBrowserType\TypeInterface     $type
     * @param int|null                         $bits
     * @param bool                             $pdfSupport
     * @param bool                             $rssSupport
     */
    public function __construct(
        $name,
        $manufacturer,
        $brand,
        Version $version = null,
        Engine $engine = null,
        TypeInterface $type = null,
        $bits = null,
        $pdfSupport = false,
        $rssSupport = false
    ) {
        $this->name                        = $name;
        $this->manufacturer                = $manufacturer;
        $this->brand                       = $brand;
        $this->version                     = $version;
        $this->engine                      = $engine;
        $this->type                        = $type;
        $this->bits                        = $bits;
        $this->pdfSupport                  = $pdfSupport;
        $this->rssSupport                  = $rssSupport;
    }

    /**
     * gets the name of the browser
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string|null
     */
    public function getModus()
    {
        return $this->modus;
    }

    /**
     * @return bool|null
     */
    public function getPdfSupport()
    {
        return $this->pdfSupport;
    }

    /**
     * @return bool|null
     */
    public function getRssSupport()
    {
        return $this->rssSupport;
    }

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return int|null
     */
    public function getBits()
    {
        return $this->bits;
    }

    /**
     * @return \UaBrowserType\TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \UaResult\Engine\Engine
     */
    public function getEngine()
    {
        return $this->engine;
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
                'name'                        => $this->name,
                'modus'                       => $this->modus,
                'version'                     => $this->version,
                'manufacturer'                => $this->manufacturer,
                'brand'                       => $this->brand,
                'pdfSupport'                  => $this->pdfSupport,
                'rssSupport'                  => $this->rssSupport,
                'bits'                        => $this->bits,
                'type'                        => $this->type,
                'engine'                      => $this->engine,
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

        $this->name                        = $unseriliazedData['name'];
        $this->modus                       = $unseriliazedData['modus'];
        $this->version                     = $unseriliazedData['version'];
        $this->manufacturer                = $unseriliazedData['manufacturer'];
        $this->brand                       = $unseriliazedData['brand'];
        $this->pdfSupport                  = $unseriliazedData['pdfSupport'];
        $this->rssSupport                  = $unseriliazedData['rssSupport'];
        $this->bits                        = $unseriliazedData['bits'];
        $this->type                        = $unseriliazedData['type'];
        $this->engine                      = $unseriliazedData['engine'];
    }
}
