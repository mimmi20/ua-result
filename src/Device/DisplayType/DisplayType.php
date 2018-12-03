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

trait DisplayType
{
    /**
     * Returns the type name of the display
     *
     * @return string
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * Returns the Width of the Display
     *
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return self::WIDTH;
    }

    /**
     * Returns the Height of the Display
     *
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return self::HEIGHT;
    }
}
