<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2019, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResultTest\Os;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\TestCase;
use UaResult\Company\CompanyInterface;
use UaResult\Os\Os;

final class OsTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testSetterGetter(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $version       = $this->createMock(VersionInterface::class);
        $bits          = 64;

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $object = new Os($name, $marketingName, $manufacturer, $version, $bits);

        static::assertSame($name, $object->getName());
        static::assertSame($marketingName, $object->getMarketingName());
        static::assertSame($manufacturer, $object->getManufacturer());
        static::assertSame($version, $object->getVersion());
        static::assertSame($bits, $object->getBits());
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \UnexpectedValueException
     *
     * @return void
     */
    public function testToarray(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $version       = $this->createMock(VersionInterface::class);
        $bits          = 64;

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);

        $array = $original->toArray();

        static::assertArrayHasKey('name', $array);
        static::assertIsString($array['name']);
        static::assertArrayHasKey('marketingName', $array);
        static::assertIsString($array['marketingName']);
        static::assertArrayHasKey('version', $array);
        static::assertIsString($array['version']);
        static::assertArrayHasKey('manufacturer', $array);
        static::assertIsString($array['manufacturer']);
        static::assertArrayHasKey('bits', $array);
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     *
     * @return void
     */
    public function testClone(): void
    {
        $name          = 'TestPlatform';
        $marketingName = 'TestMarketingname';
        $manufacturer  = $this->createMock(CompanyInterface::class);
        $version       = $this->createMock(VersionInterface::class);
        $bits          = 64;

        /** @var CompanyInterface $manufacturer */
        /** @var VersionInterface $version */
        $original = new Os($name, $marketingName, $manufacturer, $version, $bits);
        $cloned   = clone $original;

        static::assertNotSame($original, $cloned);
        static::assertNotSame($manufacturer, $cloned->getManufacturer());
        static::assertNotSame($version, $cloned->getVersion());
    }
}
