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

namespace UaResult\Bits;

enum Bits: int
{
    case eight = 8;

    case sixteen = 16;

    case thirtytwo = 32;

    case sixtyfour = 64;

    case unknown = 0;
}
