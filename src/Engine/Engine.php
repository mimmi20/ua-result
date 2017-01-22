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
use BrowserDetector\Version\VersionFactory;
use UaResult\Company\Company;
use UaResult\Company\CompanyFactory;

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
     * @var string|null
     */
    private $name = null;

    /**
     * @var \BrowserDetector\Version\Version|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\Company|null
     */
    private $manufacturer = null;

    /**
     * @param string                           $name
     * @param \UaResult\Company\Company        $manufacturer
     * @param \BrowserDetector\Version\Version $version
     */
    public function __construct($name, Company $manufacturer = null, Version $version = null)
    {
        $this->name         = $name;
        $this->manufacturer = $manufacturer;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('unknown');
        } else {
            $this->manufacturer = $manufacturer;
        }
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
            'version'      => $this->version->toArray(),
            'manufacturer' => $this->manufacturer->toArray(),
        ];
    }

    /**
     * @param array $data
     */
    private function fromArray(array $data)
    {
        $this->name         = isset($data['name']) ? $data['name'] : null;
        $this->manufacturer = isset($data['manufacturer']) ? $data['manufacturer'] : null;

        if (isset($data['version'])) {
            $this->version = (new VersionFactory())->fromArray((array) $data['version']);
        } else {
            $this->version = new Version();
        }

        if (isset($data['manufacturer'])) {
            $this->manufacturer = (new CompanyFactory())->fromArray((array) $data['manufacturer']);
        } else {
            $this->manufacturer = new Company('unknown');
        }
    }
}
