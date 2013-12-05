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

/**
 * BufferedMessagingInterface
 */
interface BufferedMessagingInterface extends \Countable
{
    /**
     * Add a message to the buffer
     *
     * @param MessageInterface $message
     */
    public function add(MessageInterface $message);

    /**
     * Will clear all the messages on the buffer
     */
    public function clear();

    /**
     * @return MessagesInterface
     */
    public function getMessages();

    /**
     * @return bool True if the messages buffer is empty
     */
    public function isEmpty();

    /**
     * Given a topic will publish the messages on the buffer
     *
     * @param string $topic
     */
    public function publish($topic);

    /**
     * Given a topic and the subtopic will consume the quantity specified from the subtopic of the topic
     * given.
     *
     * @param string $topic
     * @param string $subtopic
     * @param int    $quantity
     *
     * @return MessagesInterface
     */
    public function consume($topic, $subtopic, $quantity);
}
