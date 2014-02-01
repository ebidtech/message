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

use EBT\Collection\IterableTrait;
use EBT\Collection\CountableTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\DirectAccessTrait;
use EBT\Collection\GetItemsTrait;
use EBT\Message\Exception\InvalidArgumentException;

/**
 * MessagesMutable
 */
class MessagesMutable implements MessagesMutableInterface
{
    use IterableTrait;
    use CountableTrait;
    use EmptyTrait;
    use DirectAccessTrait;
    use GetItemsTrait;
    use MessagesAddTrait {
        add as public ;
    }

    /**
     * @var MessageInterface[]
     */
    protected $items = array();

    /**
     * @param MessageInterface[] $messages
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $messages = array())
    {
        foreach ($messages as $message) {
            $this->add($message);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function remove($messageId)
    {
        unset($this->items[$messageId]);
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->items = array();
    }

    /**
     * {@inheritDoc}
     */
    public function toMessages()
    {
        return new Messages($this->getItems());
    }
}
