<?php

/*
 * This file is a part of the Message library.
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
use EBT\Message\MessageType;

/**
 * MStoreFormatMessage
 *
 * This is a special case of message, that when possible uses JSON in case it can be used.
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

    /**
     * {@inheritDoc}
     */
    public static function getType()
    {
        return new MessageType(MessageType::MSTOREFORMAT);
    }
}
