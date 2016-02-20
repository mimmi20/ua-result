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

namespace UaResult\Version;

/**
 * a general version detector
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface VersionInterface extends \Serializable, \JsonSerializable
{
    /**
     * @var int
     */
    const MAJORONLY = 1;

    /**
     * @var int
     */
    const MINORONLY = 2;

    /**
     * @var int
     */
    const MAJORMINOR = 3;

    /**
     * @var int
     */
    const MINORMICRO = 6;

    /**
     * @var int
     */
    const MICROONLY = 4;

    /**
     * @var int
     */
    const COMPLETE = 7;

    /**
     * @var int
     */
    const IGNORE_NONE = 0;

    /**
     * @var int
     */
    const IGNORE_MINOR = 8;

    /**
     * @var int
     */
    const IGNORE_MICRO = 16;

    /**
     * @var int
     */
    const IGNORE_MINOR_IF_EMPTY = 32;

    /**
     * @var int
     */
    const IGNORE_MICRO_IF_EMPTY = 64;

    /**
     * @var int
     */
    const IGNORE_MACRO_IF_EMPTY = 128;

    /**
     * @var int
     */
    const COMPLETE_IGNORE_EMPTY = 231;

    /**
     * @var int
     */
    const GET_ZERO_IF_EMPTY = 256;

    /**
     * converts the version object into a string
     *
     * @return string
     */
    public function __toString();

    /**
     * returns the detected version
     *
     * @param int $mode
     *
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function getVersion($mode = null);

    /**
     * detects the bit count by this browser from the given user agent
     *
     * @param string|array $searches
     *
     * @throws \UnexpectedValueException
     *
     * @return VersionInterface
     */
    public function detectVersion($searches = '');

    /**
     * detects if the version is makred as Alpha
     *
     * @return bool
     */
    public function isAlpha();

    /**
     * detects if the version is makred as Beta
     *
     * @return bool
     */
    public function isBeta();
}
