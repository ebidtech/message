<?php

/**
 * LICENSE: [EMAILBIDDING_DESCRIPTION_LICENSE_HERE]
 *
 * @author     Eduardo Oliveira <eduardo.oliveira@emailbidding.com>
 * @copyright  2012-2013 Emailbidding
 * @license    [EMAILBIDDING_URL_LICENSE_HERE]
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
