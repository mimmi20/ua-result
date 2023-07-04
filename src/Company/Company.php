<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResult\Company;

final class Company implements CompanyInterface
{
    /** @throws void */
    public function __construct(
        private readonly string $type,
        private readonly string | null $name,
        private readonly string | null $brandname,
    ) {
        // nothing to do
    }

    /**
     * Returns the type name of the company
     *
     * @throws void
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Returns the name of the company
     *
     * @throws void
     */
    public function getName(): string | null
    {
        return $this->name;
    }

    /**
     * Returns the brand name of the company
     *
     * @throws void
     */
    public function getBrandName(): string | null
    {
        return $this->brandname;
    }
}
