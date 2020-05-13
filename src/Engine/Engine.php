<?php
/**
 * This file is part of the ua-result package.
 *
 * Copyright (c) 2015-2020, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UaResult\Engine;

use BrowserDetector\Version\VersionInterface;
use UaResult\Company\CompanyInterface;

final class Engine implements EngineInterface
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var \BrowserDetector\Version\VersionInterface
     */
    private $version;

    /**
     * @var \UaResult\Company\CompanyInterface
     */
    private $manufacturer;

    /**
     * @param string|null                               $name
     * @param \UaResult\Company\CompanyInterface        $manufacturer
     * @param \BrowserDetector\Version\VersionInterface $version
     */
    public function __construct(
        ?string $name,
        CompanyInterface $manufacturer,
        VersionInterface $version
    ) {
        $this->name         = $name;
        $this->manufacturer = $manufacturer;
        $this->version      = $version;
    }

    /**
     * clones the actual object
     *
     * @return Engine
     */
    public function __clone()
    {
        $this->version      = clone $this->version;
        $this->manufacturer = clone $this->manufacturer;
    }

    /**
     * @return \UaResult\Company\CompanyInterface
     */
    public function getManufacturer(): CompanyInterface
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
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function getVersion(): VersionInterface
    {
        return $this->version;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'version' => $this->version->getVersion(),
            'manufacturer' => $this->manufacturer->getType(),
        ];
    }
}
