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
namespace UaResult\Company;

final class Company implements CompanyInterface
{
    /**
     * the type name of the device
     *
     * @var string
     */
    private $type;

    /**
     * the name of the company
     *
     * @var string|null
     */
    private $name;

    /**
     * the brand name of the company
     *
     * @var string|null
     */
    private $brandname;

    /**
     * @param string      $type
     * @param string|null $name
     * @param string|null $brandname
     */
    public function __construct(string $type, ?string $name, ?string $brandname)
    {
        $this->type      = $type;
        $this->name      = $name;
        $this->brandname = $brandname;
    }

    /**
     * Returns the type name of the company
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Returns the name of the company
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Returns the brand name of the company
     *
     * @return string|null
     */
    public function getBrandName(): ?string
    {
        return $this->brandname;
    }
}
