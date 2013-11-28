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
use EBT\Message\Exception\RuntimeException;
use EBT\Message\Exception\InvalidArgumentException;

/**
 * BaseMessage
 */
abstract class BaseMessage implements MessageInterface
{
    use MessageErrorTrait;

    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public static function getStoreFormat(CompressorInterface $compressor)
    {
        return new MessageStoreFormat(MessageStoreFormat::PLAIN);
    }

    /**
     * {@inheritDoc}
     */
    public function toStore(CompressorInterface $compressor)
    {
        $data = $this->toStoreData($compressor);

        $format = static::getStoreFormat($compressor);
        switch ($format) {
            case MessageStoreFormat::JSON:
                $res = json_encode($data);
                break;
            case MessageStoreFormat::SERIALIZE:
                $res = serialize($data);
                break;
            case MessageStoreFormat::PLAIN:
                $res = $data;
                break;
            default:
                throw new RuntimeException(sprintf('%s toStore() unrecognized format "%s"', get_class($this), $format));
        }

        return $res;
    }

    /**
     * @param CompressorInterface $compressor
     *
     * @returns mixed
     */
    abstract protected function toStoreData(CompressorInterface $compressor);

    /**
     * @param mixed              $message
     * @param MessageStoreFormat $format
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    protected static function fromStoreDecode($message, MessageStoreFormat $format)
    {
        switch ($format) {
            case MessageStoreFormat::JSON:
                $message = json_decode($message, true);
                break;
            case MessageStoreFormat::SERIALIZE:
                $message = unserialize($message);
                break;
            case MessageStoreFormat::PLAIN:
                // do nothing
                break;
            default:
                throw new InvalidArgumentException(sprintf('fromStore() unrecognized format "%s"', $format));
        }

        return $message;
    }
}
