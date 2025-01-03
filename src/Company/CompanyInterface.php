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

namespace UaResult\Company;

interface CompanyInterface
{
    /**
     * Returns the type name of the company
     *
     * @throws void
     */
    public function getType(): string;

    /**
     * Returns the name of the company
     *
     * @throws void
     */
    public function getName(): string | null;

    /**
     * Returns the brand name of the company
     *
     * @throws void
     */
    public function getBrandName(): string | null;
}
