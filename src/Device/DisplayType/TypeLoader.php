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
namespace UaResult\Device\DisplayType;

use BrowserDetector\Loader\LoaderInterface;
use BrowserDetector\Loader\NotFoundException;

/**
 * Browser detection class
 *
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class TypeLoader implements LoaderInterface
{
    private const OPTIONS = [
        Cga::TYPE => Cga::class,
        Custom144x192::TYPE => Custom144x192::class,
        Custom144x256::TYPE => Custom144x256::class,
        Custom360x480::TYPE => Custom360x480::class,
        Custom600x750::TYPE => Custom600x750::class,
        Custom640x1024::TYPE => Custom640x1024::class,
        Custom640x1136::TYPE => Custom640x1136::class,
        Custom720x960::TYPE => Custom720x960::class,
        Custom720x1152::TYPE => Custom720x1152::class,
        Custom768x960::TYPE => Custom768x960::class,
        Custom864x1280::TYPE => Custom864x1280::class,
        Custom864x1536::TYPE => Custom864x1536::class,
        Custom900x1200::TYPE => Custom900x1200::class,
        Custom1080x1440::TYPE => Custom1080x1440::class,
        Custom1080x2160::TYPE => Custom1080x2160::class,
        Custom1080x2560::TYPE => Custom1080x2560::class,
        Custom1080x3840::TYPE => Custom1080x3840::class,
        Custom1440x2160::TYPE => Custom1440x2160::class,
        Custom1440x2880::TYPE => Custom1440x2880::class,
        Custom1440x2960::TYPE => Custom1440x2960::class,
        Custom1824x2736::TYPE => Custom1824x2736::class,
        Custom2000x3000::TYPE => Custom2000x3000::class,
        Custom3000x4500::TYPE => Custom3000x4500::class,
        Dci2k::TYPE => Dci2k::class,
        Dci4k::TYPE => Dci4k::class,
        Dvga::TYPE => Dvga::class,
        Fhd::TYPE => Fhd::class,
        Fwqvga1::TYPE => Fwqvga1::class,
        Fwqvga2::TYPE => Fwqvga2::class,
        Fwvga1::TYPE => Fwvga1::class,
        Fwvga2::TYPE => Fwvga2::class,
        Fwxga::TYPE => Fwxga::class,
        Fwxgaplus::TYPE => Fwxgaplus::class,
        Hdplus::TYPE => Hdplus::class,
        Hdwxga::TYPE => Hdwxga::class,
        Hqvga::TYPE => Hqvga::class,
        Hsxga::TYPE => Hsxga::class,
        Huxga::TYPE => Huxga::class,
        Hvga::TYPE => Hvga::class,
        Hxga::TYPE => Hxga::class,
        K4uhd::TYPE => K4uhd::class,
        K5uhd::TYPE => K5uhd::class,
        K8uhd::TYPE => K8uhd::class,
        Nhd::TYPE => Nhd::class,
        Qhd::TYPE => Qhd::class,
        Qhdq::TYPE => Qhdq::class,
        Qqvga::TYPE => Qqvga::class,
        Qsxga::TYPE => Qsxga::class,
        Quxga::TYPE => Quxga::class,
        Qvga::TYPE => Qvga::class,
        Qwxga::TYPE => Qwxga::class,
        Qwxgaplus::TYPE => Qwxgaplus::class,
        Qxga::TYPE => Qxga::class,
        Svga::TYPE => Svga::class,
        Sxga::TYPE => Sxga::class,
        Sxgaplus::TYPE => Sxgaplus::class,
        Unknown::TYPE => Unknown::class,
        Uvga::TYPE => Uvga::class,
        Uw5k::TYPE => Uw5k::class,
        Uw8k::TYPE => Uw8k::class,
        Uwqhd::TYPE => Uwqhd::class,
        Uwuxga::TYPE => Uwuxga::class,
        Vga::TYPE => Vga::class,
        Whsxga::TYPE => Whsxga::class,
        Whuxga::TYPE => Whuxga::class,
        Wqsxga::TYPE => Wqsxga::class,
        Wquxga::TYPE => Wquxga::class,
        Wqvga1::TYPE => Wqvga1::class,
        Wqvga2::TYPE => Wqvga2::class,
        Wqvga3::TYPE => Wqvga3::class,
        Wqvga4::TYPE => Wqvga4::class,
        Wqxga::TYPE => Wqxga::class,
        Wsvga1::TYPE => Wsvga1::class,
        Wsvga2::TYPE => Wsvga2::class,
        Wsxga::TYPE => Wsxga::class,
        Wsxgaplus::TYPE => Wsxgaplus::class,
        Wvga1::TYPE => Wvga1::class,
        Wvga2::TYPE => Wvga2::class,
        Wvga3::TYPE => Wvga3::class,
        Wxga1::TYPE => Wxga1::class,
        Wxga2::TYPE => Wxga2::class,
        Wxga3::TYPE => Wxga3::class,
        Wxgaplus::TYPE => Wxgaplus::class,
        Xga::TYPE => Xga::class,
        Xgaplus::TYPE => Xgaplus::class,
    ];

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, self::OPTIONS);
    }

    /**
     * @param string $key
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaResult\Device\DisplayType\DisplayTypeInterface
     */
    public function load(string $key): DisplayTypeInterface
    {
        if (!$this->has($key)) {
            throw new NotFoundException('the display type type with key "' . $key . '" was not found');
        }

        $class = self::OPTIONS[$key];

        return new $class();
    }
}
