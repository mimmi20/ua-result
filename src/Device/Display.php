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

final class Display implements DisplayInterface
{
    /**
     * @var bool|null
     */
    private $touch;

    /**
     * @var DisplayTypeInterface
     */
    private $type;

    /**
     * @var float|null
     */
    private $size;

    /**
     * Display constructor.
     *
     * @param bool|null                           $touch
     * @param \UaDisplaySize\DisplayTypeInterface $type
     * @param float|null                          $size
     */
    public function __construct(
        ?bool $touch,
        DisplayTypeInterface $type,
        ?float $size
    ) {
        $this->touch = $touch;
        $this->type  = $type;
        $this->size  = $size;
    }

    /**
     * clones the actual object
     *
     * @return void
     */
    public function __clone()
    {
        $this->type = clone $this->type;
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
     * Returns the display type
     *
     * @return \UaDisplaySize\DisplayTypeInterface
     */
    public function getType(): DisplayTypeInterface
    {
        return $this->type;
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
            'width' => $this->type->getWidth(),
            'height' => $this->type->getHeight(),
            'touch' => $this->touch,
            'size' => $this->size,
        ];
    }
}
