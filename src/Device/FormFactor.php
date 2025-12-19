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

enum FormFactor: string
{
    case mobile = 'Mobile';

    case desktop = 'Desktop';

    case eink = 'EInk';

    case watch = 'Watch';

    case tablet = 'Tablet';

    case automotive = 'Automotive';

    case xr = 'Xr';

    case unknown = '';
}
