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

final class Display implements DisplayInterface
{
    private ?bool $touch = null;

    private ?int $height = null;

    private ?int $width = null;

    private ?float $size = null;

    public function __construct(
        ?int $width,
        ?int $height,
        ?bool $touch,
        ?float $size
    ) {
        $this->width  = $width;
        $this->height = $height;
        $this->touch  = $touch;
        $this->size   = $size;
    }

    /**
     * Returns TRUE, if the display is a touchscreen
     */
    public function hasTouch(): ?bool
    {
        return $this->touch;
    }

    /**
     * Returns the display height
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Returns the display width
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * returns the size of the display
     */
    public function getSize(): ?float
    {
        return $this->size;
    }

    /**
     * @return array<string, bool|float|int|null>
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
