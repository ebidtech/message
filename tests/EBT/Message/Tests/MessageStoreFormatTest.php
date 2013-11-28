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

use EBT\Message\MessageStoreFormat;

/**
 * MessageStoreFormatTest
 */
class MessageStoreFormatTest extends TestCase
{
    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testUnrecognizedFormat()
    {
        new MessageStoreFormat('test');
    }

    public function testConstruct()
    {
        $format = new MessageStoreFormat(MessageStoreFormat::JSON);
        $this->assertTrue($format->isJson());
        $this->assertFalse($format->isSerialize());
        $this->assertFalse($format->isPlain());
        $this->assertEquals(MessageStoreFormat::JSON, (string) $format);

        $format = new MessageStoreFormat(MessageStoreFormat::SERIALIZE);
        $this->assertFalse($format->isJson());
        $this->assertTrue($format->isSerialize());
        $this->assertFalse($format->isPlain());
        $this->assertEquals(MessageStoreFormat::SERIALIZE, (string) $format);

        $format = new MessageStoreFormat(MessageStoreFormat::PLAIN);
        $this->assertFalse($format->isJson());
        $this->assertFalse($format->isSerialize());
        $this->assertTrue($format->isPlain());
        $this->assertEquals(MessageStoreFormat::PLAIN, (string) $format);
    }
}
