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

namespace UaResultTest\Company;

use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Company\Company;

final class CompanyTest extends TestCase
{
    /** @throws Exception */
    public function testSetterGetter(): void
    {
        $type      = 'CompanyType';
        $name      = 'TestCompany';
        $brandname = 'TestBrand';

        $company = new Company($type, $name, $brandname);

        self::assertSame($type, $company->getKey());
        self::assertSame($name, $company->getName());
        self::assertSame($brandname, $company->getBrandName());
    }
}
