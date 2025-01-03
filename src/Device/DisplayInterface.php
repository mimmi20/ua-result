<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2025, Thomas Mueller <mimmi20@live.de>
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
     *
     * @throws void
     */
    public function hasTouch(): bool | null;

    /**
     * Returns the display height
     *
     * @throws void
     */
    public function getHeight(): int | null;

    /**
     * Returns the display width
     *
     * @throws void
     */
    public function getWidth(): int | null;

    /**
     * returns the size of the display
     *
     * @throws void
     */
    public function getSize(): float | null;

    /**
     * @return array<string, bool|float|int|null>
     *
     * @throws void
     */
    public function toArray(): array;
}
