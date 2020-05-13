<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2020, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Device;

use UaDisplaySize\DisplayTypeInterface;

interface DisplayInterface
{
    /**
     * Returns TRUE, if the display is a touchscreen
     *
     * @return bool|null
     */
    public function hasTouch(): ?bool;

    /**
     * Returns the display type
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function getType(): DisplayTypeInterface;

    /**
     * returns the size of the display
     *
     * @return float|null
     */
    public function getSize(): ?float;

    /**
     * @return array
     */
    public function toArray(): array;
}
