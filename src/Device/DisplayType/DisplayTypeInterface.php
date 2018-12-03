<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device\DisplayType;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
interface DisplayTypeInterface
{
    /**
     * Returns the type name of the device
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Returns the Width of the Display
     *
     * @return int|null
     */
    public function getWidth(): ?int;

    /**
     * Returns the Height of the Display
     *
     * @return int|null
     */
    public function getHeight(): ?int;
}
