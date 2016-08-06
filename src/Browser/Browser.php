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
     * @var string the user agent to handle
     */
    private $useragent = '';

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
     * @var bool|null
     */
    private $pdfSupport = null;

    /**
     * @var bool|null
     */
    private $rssSupport = null;

    /**
     * @var bool|null
     */
    private $canSkipAlignedLinkRow = null;

    /**
     * @var bool|null
     */
    private $claimsWebSupport = null;

    /**
     * @var bool|null
     */
    private $supportsEmptyOptionValues = null;

    /**
     * @var bool|null
     */
    private $supportsBasicAuthentication = null;

    /**
     * @var bool|null
     */
    private $supportsPostMethod = null;

    /**
     * @var int|null
     */
    private $bits = null;

    /**
     * @var \UaBrowserType\TypeInterface|null
     */
    private $type = null;

    /**
     * Class Constructor
     *
     * @param string                                $useragent                   the user agent to be handled
     * @param string                                $name
     * @param \BrowserDetector\Version\Version|null $version
     * @param string|null                           $manufacturer
     * @param int|null                              $bits
     * @param \UaBrowserType\TypeInterface          $type
     * @param bool                                  $pdfSupport
     * @param bool                                  $rssSupport
     * @param bool                                  $canSkipAlignedLinkRow
     * @param bool                                  $claimsWebSupport
     * @param bool                                  $supportsEmptyOptionValues
     * @param bool                                  $supportsBasicAuthentication
     * @param bool                                  $supportsPostMethod
     */
    public function __construct(
        $useragent,
        $name,
        Version $version = null,
        $manufacturer = null,
        $bits = null,
        TypeInterface $type = null,
        $pdfSupport = false,
        $rssSupport = false,
        $canSkipAlignedLinkRow = false,
        $claimsWebSupport = false,
        $supportsEmptyOptionValues = false,
        $supportsBasicAuthentication = false,
        $supportsPostMethod = false
    ) {
        $this->useragent                   = $useragent;
        $this->name                        = $name;
        $this->version                     = $version;
        $this->manufacturer                = $manufacturer;
        $this->bits                        = $bits;
        $this->type                        = $type;
        $this->pdfSupport                  = $pdfSupport;
        $this->rssSupport                  = $rssSupport;
        $this->canSkipAlignedLinkRow       = $canSkipAlignedLinkRow;
        $this->claimsWebSupport            = $claimsWebSupport;
        $this->supportsEmptyOptionValues   = $supportsEmptyOptionValues;
        $this->supportsBasicAuthentication = $supportsBasicAuthentication;
        $this->supportsPostMethod          = $supportsPostMethod;
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
     * @return bool|null
     */
    public function getCanSkipAlignedLinkRow()
    {
        return $this->canSkipAlignedLinkRow;
    }

    /**
     * @return bool|null
     */
    public function getClaimsWebSupport()
    {
        return $this->claimsWebSupport;
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
     * @return bool|null
     */
    public function getSupportsBasicAuthentication()
    {
        return $this->supportsBasicAuthentication;
    }

    /**
     * @return bool|null
     */
    public function getSupportsEmptyOptionValues()
    {
        return $this->supportsEmptyOptionValues;
    }

    /**
     * @return bool|null
     */
    public function getSupportsPostMethod()
    {
        return $this->supportsPostMethod;
    }

    /**
     * @return string
     */
    public function getUseragent()
    {
        return $this->useragent;
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
                'useragent'                   => $this->useragent,
                'name'                        => $this->name,
                'modus'                       => $this->modus,
                'version'                     => $this->version,
                'manufacturer'                => $this->manufacturer,
                'pdfSupport'                  => $this->pdfSupport,
                'rssSupport'                  => $this->rssSupport,
                'canSkipAlignedLinkRow'       => $this->canSkipAlignedLinkRow,
                'claimsWebSupport'            => $this->claimsWebSupport,
                'supportsEmptyOptionValues'   => $this->supportsEmptyOptionValues,
                'supportsBasicAuthentication' => $this->supportsBasicAuthentication,
                'supportsPostMethod'          => $this->supportsPostMethod,
                'bits'                        => $this->bits,
                'type'                        => $this->type,
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

        $this->useragent                   = $unseriliazedData['useragent'];
        $this->name                        = $unseriliazedData['name'];
        $this->modus                       = $unseriliazedData['modus'];
        $this->version                     = $unseriliazedData['version'];
        $this->manufacturer                = $unseriliazedData['manufacturer'];
        $this->pdfSupport                  = $unseriliazedData['pdfSupport'];
        $this->rssSupport                  = $unseriliazedData['rssSupport'];
        $this->canSkipAlignedLinkRow       = $unseriliazedData['canSkipAlignedLinkRow'];
        $this->claimsWebSupport            = $unseriliazedData['claimsWebSupport'];
        $this->supportsEmptyOptionValues   = $unseriliazedData['supportsEmptyOptionValues'];
        $this->supportsBasicAuthentication = $unseriliazedData['supportsBasicAuthentication'];
        $this->supportsPostMethod          = $unseriliazedData['supportsPostMethod'];
        $this->bits                        = $unseriliazedData['bits'];
        $this->type                        = $unseriliazedData['type'];
    }
}
