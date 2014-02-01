<?php

/*
 * This file is a part of the Message library.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message;

use EBT\Message\Exception\InvalidArgumentException;

/**
 * MessagesMutableInterface
 */
interface MessagesMutableInterface extends MessagesInterface
{
    /**
     * @param MessageInterface $message
     *
     * @throws InvalidArgumentException
     */
    public function add(MessageInterface $message);

    /**
     * @param int $messageId
     */
    public function remove($messageId);

    /**
     * Will clear all messages
     */
    public function clear();

    /**
     * Will turn MessagesMutable into Messages
     *
     * @return MessagesInterface
     */
    public function toMessages();
}
