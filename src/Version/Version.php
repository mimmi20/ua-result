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
 * @package   ua-result
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace UaResult\Version;

/**
 * a general version detector
 *
 * @category  ua-result
 * @package   ua-result
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Version implements VersionInterface
{
    /**
     * @var string the user agent to handle
     */
    private $useragent = null;

    /**
     * @var string the detected complete version
     */
    private $version = null;

    /**
     * @var string the detected major version
     */
    private $major = null;

    /**
     * @var string the detected minor version
     */
    private $minor = null;

    /**
     * @var string the detected micro version
     */
    private $micro = null;

    /**
     * @var string the default version
     */
    private $default = '';

    /**
     * @var bool
     */
    private $alpha = false;

    /**
     * @var bool
     */
    private $beta = false;

    /**
     * @param string      $useragent
     * @param string|null $defaultVersion
     */
    public function __construct($useragent, $defaultVersion = null)
    {
        $this->useragent = $useragent;

        if (is_string($defaultVersion)) {
            $this->default = $defaultVersion;
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            array(
                'version'   => $this->version,
                'useragent' => $this->useragent,
                'default'   => $this->default
            )
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        $unseriliazedData = unserialize($serialized);

        $this->version   = $unseriliazedData['version'];
        $this->useragent = $unseriliazedData['useragent'];
        $this->default   = $unseriliazedData['default'];

        $this->setVersion($this->version);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return array(
            'version'   => $this->version,
            'useragent' => $this->useragent,
            'default'   => $this->default
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->getVersion(
                VersionInterface::COMPLETE
            );
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * returns the detected version
     *
     * @param integer $mode
     *
     * @return string
     * @throws \UnexpectedValueException
     */
    public function getVersion($mode = null)
    {
        if (null === $this->version) {
            if (null === $this->useragent) {
                throw new \UnexpectedValueException(
                    'You have to set the useragent before calling this function'
                );
            }

            $this->detectVersion();
        } elseif (null === $this->major) {
            $this->setVersion($this->version);
        }

        if (null === $mode) {
            $mode = VersionInterface::COMPLETE;
        }

        $versions = array();
        if (VersionInterface::MAJORONLY & $mode) {
            $versions[0] = $this->major;
        }

        if (VersionInterface::MINORONLY & $mode) {
            $versions[1] = $this->minor;
        }

        if (VersionInterface::MICROONLY & $mode) {
            $versions[2] = $this->micro;
        }

        $microIsEmpty = false;
        if (empty($versions[2]) || '0' === $versions[2] || '' === $versions[2]) {
            $microIsEmpty = true;
        }

        if (VersionInterface::IGNORE_MICRO & $mode) {
            unset($versions[2]);
        } elseif (VersionInterface::IGNORE_MICRO_IF_EMPTY & $mode && $microIsEmpty) {
            unset($versions[2]);
        }

        $minorIsEmpty = false;

        if (VersionInterface::IGNORE_MINOR & $mode) {
            unset($versions[1]);
            unset($versions[2]);
            $minorIsEmpty = true;
        } elseif (VersionInterface::IGNORE_MINOR_IF_EMPTY & $mode) {
            if ($microIsEmpty
                && (empty($versions[1]) || '0' === $versions[1] || '00' === $versions[1] || '' === $versions[1])
            ) {
                $minorIsEmpty = true;
            }

            if ($minorIsEmpty) {
                unset($versions[1]);
                unset($versions[2]);
            }
        }

        $macroIsEmpty = false;

        if (VersionInterface::IGNORE_MACRO_IF_EMPTY & $mode) {
            if ((empty($versions[0]) || '0' === $versions[0] || '' === $versions[0]) && $minorIsEmpty) {
                $macroIsEmpty = true;
            }

            if ($macroIsEmpty) {
                unset($versions[0]);
                unset($versions[1]);
                unset($versions[2]);
            }
        }

        $version = implode('.', $versions);

        if ('0' === $version || '0.0' === $version || '0.0.0' === $version) {
            $version = '';
        }

        if (VersionInterface::GET_ZERO_IF_EMPTY & $mode && '' === $version) {
            $version = '0';
        }

        return $version;
    }

    /**
     * detects the bit count by this browser from the given user agent
     *
     * @param string|array $searches
     *
     * @return Version
     * @throws \UnexpectedValueException
     */
    public function detectVersion($searches = '')
    {
        if (!is_array($searches) && !is_string($searches)) {
            throw new \UnexpectedValueException(
                'a string or an array of strings is expected as parameter'
            );
        }

        if (!is_array($searches)) {
            $searches = array($searches);
        }

        $modifiers = array(
            array('\/', ''),
            array('\(', '\)'),
            array(' ', ''),
            array('', ''),
            array(' \(', '\;')
        );

        /** @var $version string */
        $version   = $this->default;
        $useragent = $this->useragent;

        if (false !== strpos($useragent, '%')) {
            $useragent = urldecode($useragent);
        }

        foreach ($searches as $search) {
            if (!is_string($search)) {
                continue;
            }

            if (false !== strpos($search, '%')) {
                $search = urldecode($search);
            }

            $found = false;

            foreach ($modifiers as $modifier) {
                $compareString = '/' . $search . $modifier[0] . '(\d+[\d\.\_ab]*)' . $modifier[1] . '/';

                $doMatch = preg_match(
                    $compareString,
                    $useragent,
                    $matches
                );

                if ($doMatch) {
                    $version = $matches[1];
                    $found   = true;
                    break;
                }
            }

            if ($found) {
                break;
            }
        }

        return $this->setVersion($version);
    }

    /**
     * detects if the version is marked as Alpha
     *
     * @return boolean
     */
    public function isAlpha()
    {
        return $this->alpha;
    }

    /**
     * detects if the version is marked as Beta
     *
     * @return boolean
     */
    public function isBeta()
    {
        return $this->beta;
    }

    /**
     * sets the detected version
     *
     * @param string $version
     *
     * @return Version
     * @throws \UnexpectedValueException
     */
    private function setVersion($version)
    {
        $version  = trim(trim(str_replace('_', '.', $version)), '.');
        $splitted = explode('.', $version, 3);

        $this->major = (!empty($splitted[0]) ? $splitted[0] : '0');
        $this->minor = (!empty($splitted[1]) ? $splitted[1] : '0');
        $this->micro = (!empty($splitted[2]) ? $splitted[2] : '0');

        $this->version = $version;
        $this->alpha   = (false !== strpos($this->version, 'a'));
        $this->beta    = (false !== strpos($this->version, 'b'));

        return $this;
    }
}
