<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Device;

final class Display implements DisplayInterface
{
    /** @throws void */
    public function __construct(
        private int | null $width = null,
        private int | null $height = null,
        private bool | null $touch = null,
        private float | null $size = null,
    ) {
        // nothing to do
    }

    /**
     * Returns TRUE, if the display is a touchscreen
     *
     * @throws void
     */
    public function hasTouch(): bool | null
    {
        return $this->touch;
    }

    /**
     * Returns the display height
     *
     * @throws void
     */
    public function getHeight(): int | null
    {
        return $this->height;
    }

    /**
     * Returns the display width
     *
     * @throws void
     */
    public function getWidth(): int | null
    {
        return $this->width;
    }

    /**
     * returns the size of the display
     *
     * @throws void
     */
    public function getSize(): float | null
    {
        return $this->size;
    }

    /**
     * @return array<string, bool|float|int|null>
     *
     * @throws void
     */
    public function toArray(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'touch' => $this->touch,
            'size' => $this->size,
        ];
    }
}
