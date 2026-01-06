<?php

/**
 * This file is part of the mimmi20/ua-result package.
 *
 * Copyright (c) 2015-2026, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Company;

use Override;
use UaData\CompanyInterface;

final readonly class Company implements CompanyInterface
{
    /** @throws void */
    public function __construct(private string $type, private string | null $name, private string | null $brandname)
    {
        // nothing to do
    }

    /**
     * Returns the type name of the company
     *
     * @throws void
     */
    #[Override]
    public function getKey(): string
    {
        return $this->type;
    }

    /**
     * Returns the name of the company
     *
     * @throws void
     */
    #[Override]
    public function getName(): string | null
    {
        return $this->name;
    }

    /**
     * Returns the brand name of the company
     *
     * @throws void
     */
    #[Override]
    public function getBrandName(): string | null
    {
        return $this->brandname;
    }
}
