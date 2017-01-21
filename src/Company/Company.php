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

namespace UaResult\Company;

/**
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Company implements CompanyInterface, \Serializable
{
    /**
     * the name of the company
     *
     * @var string
     */
    private $name = null;

    /**
     * the brand name of the company
     *
     * @var string
     */
    private $brandname = null;

    /**
     * @param string      $name
     * @param string|null $brandname
     */
    public function __construct($name, $brandname = null)
    {
        $this->name      = $name;
        $this->brandname = $brandname;
    }

    /**
     * Returns the name of the company
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Returns the name of the company
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->name;
    }

    /**
     * Returns the brand name of the company
     *
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brandname;
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
     * @param string $data <p>
     *                     The string representation of the object.
     *                     </p>
     */
    public function unserialize($data)
    {
        $unseriliazedData = unserialize($data);

        $this->name      = $unseriliazedData['name'];
        $this->brandname = $unseriliazedData['brand'];
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
            'name'  => $this->name,
            'brand' => $this->brandname,
        ];
    }

    /**
     * @param array $data
     */
    private function fromArray(array $data)
    {
        $this->major     = isset($data['major']) ? $data['major'] : null;
        $this->minor     = isset($data['minor']) ? $data['minor'] : null;
        $this->micro     = isset($data['micro']) ? $data['micro'] : null;
        $this->stability = isset($data['stability']) ? $data['stability'] : null;
        $this->build     = isset($data['build']) ? $data['build'] : null;
    }
}
