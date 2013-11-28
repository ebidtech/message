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

use EBT\Message\Messages;
use EBT\Message\Simple\SimpleMessage;

/**
 * MessagesTest
 */
class MessagesTest extends TestCase
{
    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testDuplicate()
    {
        new Messages(
            array(
                new SimpleMessage(1, 'test1'),
                new SimpleMessage(1, 'test2')
            )
        );
    }

    public function testIterable()
    {
        $messagesArr = array(
            new SimpleMessage(1, 'test1'),
            new SimpleMessage(2, 'test2')
        );

        $messages = new Messages($messagesArr);
        $this->assertCount(2, $messages);

        $pos = 0;
        foreach ($messages as $message) {
            $this->assertEquals($messagesArr[$pos], $message);
            ++$pos;
        }
    }
}
