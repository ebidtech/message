<?php

/*
 * This file is a part of the Redis queue.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message\Tests\Message\MStoreFormat;

use EBT\Message\Tests\TestCase;
use EBT\Message\MStoreFormat\MStoreFormatMessage;
use EBT\Compress\NullCompressor;
use EBT\Compress\GzencodeCompressor;

/**
 * MStoreFormatMessageTest
 */
class MStoreFormatMessageTest extends TestCase
{
    public function testToFromStore()
    {
        $id = 1;
        $data = 'just a test';
        $error = false;
        $urgent = true;

        $simpleMessage = new MStoreFormatMessage($id, $data, $error, $urgent);
        $this->assertEquals($id, $simpleMessage->getId());
        $this->assertEquals($data, $simpleMessage->getData());
        $this->assertFalse($simpleMessage->isError());
        $this->assertFalse($simpleMessage->getError());
        $this->assertEquals($urgent, $simpleMessage->isUrgent());

        $compressorNull = new NullCompressor();
        $store = $simpleMessage->toStore($compressorNull);
        $this->assertEquals(
            json_encode(
                array(
                    'id' => $id,
                    'error' => $error,
                    'urgent' => $urgent,
                    'data' => $data
                )
            ),
            $store
        );

        $simpleMessageFromJson = MStoreFormatMessage::fromStore(
            $store,
            MStoreFormatMessage::getStoreFormat($compressorNull),
            $compressorNull
        );

        $this->assertEquals($simpleMessage, $simpleMessageFromJson);

        $compressorGzencode = new GzencodeCompressor();
        $store = $simpleMessage->toStore($compressorGzencode);
        $this->assertInternalType('array', $store);

        $simpleMessageFromSerialize = MStoreFormatMessage::fromStore(
            $store,
            MStoreFormatMessage::getStoreFormat($compressorGzencode),
            $compressorGzencode
        );

        $this->assertEquals($simpleMessageFromSerialize, $simpleMessageFromJson);
    }
}
