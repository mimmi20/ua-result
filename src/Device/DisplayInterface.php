<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Device;

interface DisplayInterface
{
    /**
     * Returns TRUE, if the display is a touchscreen
     */
    public function hasTouch(): ?bool;

    /**
     * Returns the display height
     */
    public function getHeight(): ?int;

    /**
     * Returns the display width
     */
    public function getWidth(): ?int;

    /**
     * returns the size of the display
     */
    public function getSize(): ?float;

    /**
     * @return array<string, bool|float|int|null>
     */
    public function toArray(): array;
}
