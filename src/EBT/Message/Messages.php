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

use EBT\Collection\CollectionDirectInterface;
use EBT\Collection\IterableTrait;
use EBT\Collection\CountableTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\DirectAccessTrait;
use EBT\Collection\GetCollectionTrait;
use EBT\Message\Exception\InvalidArgumentException;

/**
 * Messages
 */
class Messages implements CollectionDirectInterface
{
    use IterableTrait;
    use CountableTrait;
    use EmptyTrait;
    use DirectAccessTrait;
    use GetCollectionTrait;

    /**
     * @var MessageInterface[]
     */
    private $collection = array();

    /**
     * @param MessageInterface[] $messages
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $messages)
    {
        foreach ($messages as $message) {
            $this->add($message);
        }
    }

    /**
     * @param MessageInterface $message
     *
     * @throws InvalidArgumentException
     */
    protected function add(MessageInterface $message)
    {
        $msgId = $message->getId();

        if ($this->get($msgId) instanceof MessageInterface) {
            throw new InvalidArgumentException(sprintf('Found duplicate messages with ID: "%s"', $msgId));
        }

        $this->collection[$msgId] = $message;
    }
}
