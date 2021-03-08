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
    /** @var bool|null */
    private $touch;

    /** @var int|null */
    private $height;

    /** @var int|null */
    private $width;

    /** @var float|null */
    private $size;

    /**
     * @param bool|null  $touch
     * @param int|null   $width
     * @param int|null   $height
     * @param float|null $size
     */
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
     *
     * @return bool|null
     */
    public function hasTouch(): ?bool
    {
        return $this->touch;
    }

    /**
     * Returns the display height
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }

    /**
     * Returns the display width
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * returns the size of the display
     *
     * @return float|null
     */
    public function getSize(): ?float
    {
        return $this->size;
    }

    /**
     * @return array
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
