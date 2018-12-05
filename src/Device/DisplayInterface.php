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
namespace UaResult\Device;

use UaDisplaySize\DisplayTypeInterface;

interface DisplayInterface
{
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
    public function getType(): ?DisplayTypeInterface;

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
