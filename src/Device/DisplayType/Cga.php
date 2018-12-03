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

final class Cga implements DisplayTypeInterface
{
    use DisplayType;

    public const TYPE = 'CGA';

    /**
     * the display with
     */
    private const WIDTH = 320;

    /**
     * the display height
     */
    private const HEIGHT = 200;
}
