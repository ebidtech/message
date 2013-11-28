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

use EBT\Message\MessageType;
use EBT\Message\Simple\SimpleMessage;

/**
 * MessageTypeTest
 */
class MessageTypeTest extends TestCase
{
    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testInvalidType()
    {
        new MessageType('test');
    }

    public function testValidType()
    {
        $type = new MessageType(SimpleMessage::getType());
        $this->assertEquals(SimpleMessage::getType(), (string) $type);
        $this->assertEquals('EBT\\Message\\Simple\\SimpleMessage', $type->getClassName());
    }
}
