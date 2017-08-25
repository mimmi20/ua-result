<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Engine;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionInterface;
use UaResult\Company\Company;
use UaResult\Company\CompanyInterface;

/**
 * base class for all rendering engines to detect
 *
 * @category  ua-result
 *
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Engine implements EngineInterface
{
    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var \BrowserDetector\Version\VersionInterface|null
     */
    private $version = null;

    /**
     * @var \UaResult\Company\CompanyInterface|null
     */
    private $manufacturer = null;

    /**
     * @param string|null                                    $name
     * @param \UaResult\Company\CompanyInterface|null        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface|null $version
     */
    public function __construct(
        ?string $name = null,
        ?CompanyInterface $manufacturer = null,
        ?VersionInterface $version = null
    ) {
        $this->name = $name;

        if (null === $version) {
            $this->version = new Version();
        } else {
            $this->version = $version;
        }

        if (null === $manufacturer) {
            $this->manufacturer = new Company('Unknown', null);
        } else {
            $this->manufacturer = $manufacturer;
        }
    }

    public function __clone()
    {
        $this->version      = clone $this->version;
        $this->manufacturer = clone $this->manufacturer;
    }

    /**
     * @return \UaResult\Company\CompanyInterface|null
     */
    public function getManufacturer(): ?CompanyInterface
    {
        return $this->manufacturer;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return \BrowserDetector\Version\VersionInterface|null
     */
    public function getVersion(): ?VersionInterface
    {
        return $this->version;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'version'      => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
        ];
    }
}
