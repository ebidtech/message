<?php

/*
 * This file is a part of the Message library.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message\Tests;

use EBT\Message\BaseMessage;
use EBT\Message\MessageStoreFormat;
use EBT\Compress\NullCompressor;

/**
 * BaseMessageTest
 */
class BaseMessageTest extends TestCase
{
    public function testGetStoreFormat()
    {
        $format = BaseMessage::getStoreFormat(new NullCompressor());
        $this->assertTrue($format->isPlain());
    }
}
