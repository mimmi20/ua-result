<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace UaResultTest\Company;

use InvalidArgumentException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use UaResult\Company\Company;

final class CompanyTest extends TestCase
{
    private const TYPE      = 'CompanyType';
    private const NAME      = 'TestCompany';
    private const BRANDNAME = 'TestBrand';

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function testSetterGetter(): void
    {
        $object = new Company(self::TYPE, self::NAME, self::BRANDNAME);

        self::assertSame(self::TYPE, $object->getType());
        self::assertSame(self::NAME, $object->getName());
        self::assertSame(self::BRANDNAME, $object->getBrandName());
    }
}
