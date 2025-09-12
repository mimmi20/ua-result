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

enum Architecture: string
{
    case x86 = 'x86';

    case x64 = 'x64';

    case arm = 'arm';

    case unknown = '';
}
