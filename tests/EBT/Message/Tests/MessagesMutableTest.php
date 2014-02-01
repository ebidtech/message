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

use EBT\Message\MessagesMutable;
use EBT\Message\Simple\SimpleMessage;

/**
 * MessagesMutableTest
 */
class MessagesMutableTest extends TestCase
{
    public function testAddRemove()
    {
        $messages = new MessagesMutable();
        $this->assertCount(0, $messages);
        $messages->add(new SimpleMessage(1, 'payload1'));
        $messages->add(new SimpleMessage(2, 'payload2'));
        $this->assertCount(2, $messages);
        $messages->remove(1);
        $this->assertCount(1, $messages);
        $messages->remove(2);
        $this->assertCount(0, $messages);
    }

    public function testClear()
    {
        $messages = new MessagesMutable(array(new SimpleMessage(1, 'payload1')));
        $this->assertCount(1, $messages);
        $messages->clear();
        $this->assertCount(0, $messages);
        $messages->add(new SimpleMessage(1, 'payload1'));
        $messages->clear();
        $this->assertCount(0, $messages);
    }

    public function testToMessages()
    {
        $messagesMutable = new MessagesMutable(array(new SimpleMessage(1, 'payload1')));
        $messages = $messagesMutable->toMessages();
        $this->assertInstanceOf('EBT\Message\Messages', $messages);
        $this->assertCount(1, $messages);
    }
}
