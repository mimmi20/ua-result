<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Os;

/**
 * interface for all platforms/operating systems to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface OsInterface
{
    /**
     * @return int|null
     */
    public function getBits();

    /**
     * @return \UaResult\Company\Company|null
     */
    public function getManufacturer();

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return string|null
     */
    public function getMarketingName();

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion();

    /**
     * @return array
     */
    public function toArray();
}
