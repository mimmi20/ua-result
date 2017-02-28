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
namespace UaResult\Device;

/**
 * interface for all devices to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface DeviceInterface
{
    /**
     * @return string|null
     */
    public function getDeviceName();

    /**
     * @return \UaResult\Company\Company|null
     */
    public function getBrand();

    /**
     * @return int|null
     */
    public function getColors();

    /**
     * @return bool|null
     */
    public function getDualOrientation();

    /**
     * @return bool|null
     */
    public function getHasQwertyKeyboard();

    /**
     * @return \UaResult\Company\Company|null
     */
    public function getManufacturer();

    /**
     * @return string|null
     */
    public function getMarketingName();

    /**
     * @return bool|null
     */
    public function getNfcSupport();

    /**
     * @return string|null
     */
    public function getPointingMethod();

    /**
     * @return int|null
     */
    public function getResolutionHeight();

    /**
     * @return int|null
     */
    public function getResolutionWidth();

    /**
     * @return bool|null
     */
    public function getSmsSupport();

    /**
     * @return \UaDeviceType\TypeInterface|null
     */
    public function getType();

    /**
     * @return array
     */
    public function toArray();
}
