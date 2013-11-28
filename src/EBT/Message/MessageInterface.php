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

use EBT\Compress\CompressorInterface;

/**
 * MessageInterface
 */
interface MessageInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return bool
     */
    public function isUrgent();

    /**
     * @return bool|string False when no error is present and a string with the error message if a error is present.
     */
    public function getError();

    /**
     * @return bool True if an error is marked
     */
    public function isError();

    /**
     * The type of the message to be able to know what class is responsible for this message.
     *
     * @return MessageType
     */
    public static function getType();

    /**
     * Should return a JSON/serialized representation.
     *
     * @param CompressorInterface $compressor
     *
     * @return string
     */
    public function toStore(CompressorInterface $compressor);

    /**
     * @param CompressorInterface $compressor
     *
     * @return MessageStoreFormat
     */
    public static function getStoreFormat(CompressorInterface $compressor);

    /**
     * @param string              $message  Message in the stored format
     * @param MessageStoreFormat  $format
     * @param CompressorInterface $compressor
     *
     * @return MessageInterface An payload object
     */
    public static function fromStore($message, MessageStoreFormat $format, CompressorInterface $compressor);
}
