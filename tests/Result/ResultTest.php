<?php
/**
 * Copyright (c) 2015, 2016, Thomas Mueller <mimmi20@live.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  ua-result
 *
 * @author    Thomas Mueller <mimmi20@live.de>
 * @copyright 2015, 2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/ua-result
 */

namespace UaResultTest\Result;

use UaResult\Result\Result;
use Wurfl\Request\GenericRequestFactory;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterGetter()
    {
        $requestFactory = new GenericRequestFactory();
        $request        = $requestFactory->createRequestForUserAgent('test-ua');

        $device = $this->createMock('\UaResult\Device\Device');
        $os     = $this->createMock('\UaResult\Os\Os');
        $browser = $this->createMock('\UaResult\Browser\Browser');
        $engine = $this->createMock('\UaResult\Engine\Engine');
        $capabilities = [];
        $wurflKey = 'test';

        $object = new Result($request, $device, $os, $browser, $engine, $capabilities, $wurflKey);

        self::assertSame($request, $object->getRequest());
        self::assertSame($device, $object->getDevice());
        self::assertSame($os, $object->getOs());
        self::assertSame($browser, $object->getBrowser());
        self::assertSame($engine, $object->getEngine());
        self::assertInternalType('array', $object->getCapabilities());
        self::assertSame($wurflKey, $object->getWurflKey());
    }
}
 