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
namespace UaResult\Device;

use BrowserDetector\Loader\NotFoundException;
use Psr\Log\LoggerInterface;
use UaResult\Device\DisplayType\TypeLoader;

class DisplayFactory
{
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array                    $data
     *
     * @return \UaResult\Device\DisplayInterface
     */
    public function fromArray(LoggerInterface $logger, array $data): DisplayInterface
    {
        $width  = array_key_exists('width', $data) ? (int) $data['width'] : null;
        $height = array_key_exists('height', $data) ? (int) $data['height'] : null;
        $touch  = array_key_exists('touch', $data) ? (bool) $data['touch'] : null;

        $type = null;
        if (isset($data['type'])) {
            try {
                $type = (new TypeLoader())->load((string) $data['type']);
            } catch (NotFoundException $e) {
                $logger->info($e);
            }
        }

        return new Display($width, $height, $touch, $type);
    }
}
