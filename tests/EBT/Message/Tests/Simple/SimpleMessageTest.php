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

use EBT\Message\Tests\TestCase;
use EBT\Message\Simple\SimpleMessage;
use EBT\Compress\NullCompressor;
use EBT\Compress\GzencodeCompressor;

/**
 * SimpleMessageTest
 */
class SimpleMessageTest extends TestCase
{
    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testConstructInvalidId()
    {
        new SimpleMessage(new \stdClass(), 'test');
    }

    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testConstructInvalidData()
    {
        new SimpleMessage(1, new \stdClass());
    }

    public function testNotUrgentByDefault()
    {
        $simpleMessage = new SimpleMessage(1, 'data');
        $this->assertFalse($simpleMessage->isUrgent());
    }

    public function testToFromStore()
    {
        $id = 1;
        $data = 'just a test';
        $error = 'just another error';
        $urgent = true;

        $simpleMessage = new SimpleMessage($id, $data, $error, $urgent);
        $this->assertEquals($id, $simpleMessage->getId());
        $this->assertEquals($data, $simpleMessage->getData());
        $this->assertInternalType('string', $simpleMessage->getError());
        $this->assertTrue($simpleMessage->isError());
        $this->assertEquals($urgent, $simpleMessage->isUrgent());

        $compressorNull = new NullCompressor();
        $store = $simpleMessage->toStore($compressorNull);
        $this->assertEquals(
            array(
                'id' => $id,
                'urgent' => $urgent,
                'error' => $error,
                'data' => $data
            ),
            $store
        );

        $simpleMessageFromJson = SimpleMessage::fromStore(
            $store,
            SimpleMessage::getStoreFormat($compressorNull),
            $compressorNull
        );

        $this->assertEquals($simpleMessage, $simpleMessageFromJson);

        $compressorGzencode = new GzencodeCompressor();
        $store = $simpleMessage->toStore($compressorGzencode);
        $this->assertInternalType('array', $store);

        $simpleMessageFromSerialize = SimpleMessage::fromStore(
            $store,
            SimpleMessage::getStoreFormat($compressorGzencode),
            $compressorGzencode
        );

        $this->assertEquals($simpleMessageFromSerialize, $simpleMessageFromJson);
    }

    /**
     * @expectedException \EBT\Message\Exception\InvalidArgumentException
     */
    public function testFromStoreMissingKeys()
    {
        $compressorNull = new NullCompressor();
        SimpleMessage::fromStore(
            array(),
            SimpleMessage::getStoreFormat($compressorNull),
            $compressorNull
        );
    }
}
