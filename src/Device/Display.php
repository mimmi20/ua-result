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

use UaResult\Device\DisplayType\DisplayTypeInterface;
use UaResult\Device\DisplayType\Unknown;

class Display implements DisplayInterface
{
    /**
     * @var int|null
     */
    private $width;

    /**
     * @var int|null
     */
    private $height;

    /**
     * @var bool|null
     */
    private $touch;

    /**
     * @var DisplayTypeInterface
     */
    private $type;

    /**
     * Display constructor.
     *
     * @param int|null                                               $width
     * @param int|null                                               $height
     * @param bool|null                                              $touch
     * @param \UaResult\Device\DisplayType\DisplayTypeInterface|null $type
     */
    public function __construct(
        ?int $width,
        ?int $height,
        ?bool $touch,
        ?DisplayTypeInterface $type
    ) {
        $this->width  = $width;
        $this->height = $height;
        $this->touch  = $touch;

        if (null === $type) {
            $this->type = new Unknown();
        } else {
            $this->type = $type;
        }
    }

    /**
     * Returns the Width of the Display
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * Returns the Height of the Display
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
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
     * @return \UaResult\Device\DisplayType\DisplayTypeInterface|null
     */
    public function getType(): ?DisplayTypeInterface
    {
        return $this->type;
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
            'type' => $this->type->getType(),
        ];
    }
}
