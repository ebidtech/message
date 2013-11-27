<?php

/*
 * This file is a part of the Redis queue.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message\MStoreFormat;

use EBT\Compress\CompressorInterface;
use EBT\Message\Simple\SimpleMessage;
use EBT\Message\MessageStoreFormat;

/**
 * MStoreFormatMessage
 *
 * This is a special case of message, that when possible uses JSON, before enqueue items are serialized, leaving a big
 * mess to understand if looking at the raw item at the queue.
 *
 * If the message is json encoded and the the item serialized it looks quite readable, but json encode supports just
 * UFT-8 so if the compressor doesn't generate just UTF-8 cannot be json encoded so it fallback to don't do anything.
 *
 */
class MStoreFormatMessage extends SimpleMessage
{
    /**
     * {@inheritDoc}
     */
    public static function getStoreFormat(CompressorInterface $compressor)
    {
        if ($compressor->compressUTF8encoded()) {
            return new MessageStoreFormat(MessageStoreFormat::JSON);
        }

        // having compression means that non utf8 chars can appear, JSON don't support it so lets go with plain
        // at a higher level will be serialized
        return new MessageStoreFormat(MessageStoreFormat::PLAIN);
    }
}
