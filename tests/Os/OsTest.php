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
namespace UaResultTest\Os;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use PHPUnit\Framework\TestCase;
use UaResult\Company\CompanyInterface;
use UaResult\Os\Os;

final class OsTest extends TestCase
{
    /**
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

        self::assertSame($name, $object->getName());
        self::assertSame($marketingName, $object->getMarketingName());
        self::assertSame($manufacturer, $object->getManufacturer());
        self::assertSame($version, $object->getVersion());
        self::assertSame($bits, $object->getBits());
    }

    /**
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

        self::assertArrayHasKey('name', $array);
        self::assertInternalType('string', $array['name']);
        self::assertArrayHasKey('marketingName', $array);
        self::assertInternalType('string', $array['marketingName']);
        self::assertArrayHasKey('version', $array);
        self::assertInternalType('string', $array['version']);
        self::assertArrayHasKey('manufacturer', $array);
        self::assertInternalType('string', $array['manufacturer']);
        self::assertArrayHasKey('bits', $array);
    }

    /**
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

        self::assertNotSame($original, $cloned);
        self::assertNotSame($manufacturer, $cloned->getManufacturer());
        self::assertNotSame($version, $cloned->getVersion());
    }
}
