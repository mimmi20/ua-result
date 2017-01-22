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
use BrowserDetector\Version\VersionFactory;
use UaBrowserType\Type;
use UaBrowserType\TypeFactory;
use UaBrowserType\TypeInterface;
use UaResult\Company\Company;
use UaResult\Company\CompanyFactory;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineFactory;

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
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

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
     * @param \UaResult\Company\Company        $manufacturer
     * @param \BrowserDetector\Version\Version $version
     * @param \UaResult\Engine\Engine          $engine
     * @param \UaBrowserType\TypeInterface     $type
     * @param int|null                         $bits
     * @param bool                             $pdfSupport
     * @param bool                             $rssSupport
     * @param string|null                      $modus
     */
    public function __construct(
        $name,
        Company $manufacturer,
        Version $version = null,
        Engine $engine = null,
        TypeInterface $type = null,
        $bits = null,
        $pdfSupport = false,
        $rssSupport = false,
        $modus = null
    ) {
        $this->name       = $name;
        $this->bits       = $bits;
        $this->pdfSupport = $pdfSupport;
        $this->rssSupport = $rssSupport;
        $this->modus      = $modus;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $engine) {
            $this->engine = new Engine('unknown');
        } else {
            $this->engine = $engine;
        }

        if (null === $type) {
            $this->type = new Type('unknown');
        } else {
            $this->type = $type;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('unknown');
        } else {
            $this->manufacturer = $manufacturer;
        }
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
     * @return \UaResult\Company\Company|null
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
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
        return serialize($this->toArray());
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

        $this->fromArray($unseriliazedData);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'         => $this->name,
            'modus'        => $this->modus,
            'version'      => $this->version->toArray(),
            'manufacturer' => $this->manufacturer->toArray(),
            'pdfSupport'   => $this->pdfSupport,
            'rssSupport'   => $this->rssSupport,
            'bits'         => $this->bits,
            'type'         => $this->type->toArray(),
            'engine'       => $this->engine->toArray(),
        ];
    }

    /**
     * @param array $data
     */
    private function fromArray(array $data)
    {
        $this->name         = isset($data['name']) ? $data['name'] : null;
        $this->modus        = isset($data['modus']) ? $data['modus'] : null;
        $this->manufacturer = isset($data['manufacturer']) ? $data['manufacturer'] : null;
        $this->pdfSupport   = isset($data['pdfSupport']) ? $data['pdfSupport'] : null;
        $this->rssSupport   = isset($data['rssSupport']) ? $data['rssSupport'] : null;
        $this->bits         = isset($data['bits']) ? $data['bits'] : null;

        if (isset($data['type'])) {
            $this->type = (new TypeFactory())->fromArray((array) $data['type']);
        } else {
            $this->type = new Type('unknown');
        }

        if (isset($data['version'])) {
            $this->version = (new VersionFactory())->fromArray((array) $data['version']);
        } else {
            $this->version = new Version();
        }

        if (isset($data['engine'])) {
            $this->engine = (new EngineFactory())->fromArray((array) $data['engine']);
        } else {
            $this->engine = new Engine('unknown');
        }

        if (isset($data['manufacturer'])) {
            $this->manufacturer = (new CompanyFactory())->fromArray((array) $data['manufacturer']);
        } else {
            $this->manufacturer = new Company('unknown');
        }
    }
}
