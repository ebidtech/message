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
 * MessagesAddTrait
 */
trait MessagesAddTrait
{
    /**
     * @param MessageInterface $message
     *
     * @throws InvalidArgumentException
     */
    protected function add(MessageInterface $message)
    {
        $messageId = $message->getId();

        if ($this->get($messageId) instanceof MessageInterface) {
            throw new InvalidArgumentException(sprintf('Found duplicate messages with ID: "%s"', $messageId));
        }

        $this->collection[$messageId] = $message;
    }

    /**
     * @param mixed $index
     * @param mixed $defaultValue Will be returned if the index is not present at collection
     *
     * @return mixed Null if not present
     */
    abstract public function get($index, $defaultValue = null);
}
