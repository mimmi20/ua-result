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
namespace UaResult\Engine;

/**
 * interface for all rendering engines to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface EngineInterface
{
    /**
     * @return \UaResult\Company\Company|null
     */
    public function getManufacturer();

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return \BrowserDetector\Version\Version|null
     */
    public function getVersion();

    /**
     * @return array
     */
    public function toArray();
}
