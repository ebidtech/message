<?php

/*
 * This file is a part of the Message library.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message\Simple;

use EBT\Message\BaseMessage;
use EBT\Message\MessageStoreFormat;
use EBT\Message\MessageType;
use EBT\Message\Exception\InvalidArgumentException;
use EBT\Compress\CompressorInterface;

/**
 * SimpleMessage
 */
class SimpleMessage extends BaseMessage
{
    const DEFAULT_URGENT = false;
    const DEFAULT_ERROR = false;

    const ID_KEY = 'id';
    const URGENT_KEY = 'urgent';
    const ERROR_KEY = 'error';
    const DATA_KEY = 'data';

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var bool
     */
    protected $urgent = self::DEFAULT_URGENT;

    /**
     * @param mixed       $id
     * @param mixed       $data
     * @param bool|string $error
     * @param bool        $urgent
     */
    public function __construct($id, $data, $error = self::DEFAULT_ERROR, $urgent = self::DEFAULT_URGENT)
    {
        $this->id = $this->getScalar('id', $id);
        $this->data = $this->getScalar('data', $data);
        $this->setError($error);
        $this->urgent = (bool) $urgent;
    }

    /**
     * @param string $key
     * @param mixed$val
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    protected function getScalar($key, $val)
    {
        if (!is_scalar($val) && !(is_object($val) && method_exists($val, '__toString'))) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s must be a scalar or implement __toString got "%s".',
                    $key,
                    is_object($val) ? get_class($val) : gettype($val)
                )
            );
        }

        return is_object($val) ? (string) $val : $val;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function isUrgent()
    {
        return $this->urgent;
    }

    /**
     * {@inheritDoc}
     */
    public static function getType()
    {
        return new MessageType(MessageType::SIMPLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function toStoreData(CompressorInterface $compressor)
    {
        return array(
            static::ID_KEY => $this->getId(),
            static::ERROR_KEY => $this->getError(),
            static::URGENT_KEY => $this->isUrgent(),
            static::DATA_KEY => $compressor->compress($this->getData())
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function fromStore($message, MessageStoreFormat $format, CompressorInterface $compressor)
    {
        $message = static::fromStoreDecode($message, $format);

        if (!isset($message[static::ID_KEY], $message[static::DATA_KEY])) {
            throw new InvalidArgumentException('SimpleMessage fromStore missing keys');
        }

        $error = isset($message[static::ERROR_KEY]) ? $message[static::ERROR_KEY] : static::DEFAULT_ERROR;
        $urgent = isset($message[static::URGENT_KEY]) ? $message[static::URGENT_KEY] : static::DEFAULT_URGENT;

        return new static(
            $message[static::ID_KEY],
            $compressor->uncompress($message[static::DATA_KEY]),
            $error,
            $urgent
        );
    }
}
