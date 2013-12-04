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
 * MessagingInterface
 */
interface MessagingInterface
{
    /**
     * Given a topic will publish the messages.
     *
     * @param string            $topic
     * @param MessagesInterface $messages
     */
    public function publish($topic, MessagesInterface $messages);

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
