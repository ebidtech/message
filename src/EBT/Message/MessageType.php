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
 * MessageType
 */
class MessageType
{
    const SIMPLE = 'simple';
    const MSTOREFORMAT = 'mstoreformat';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected static $mapping = array(
        self::SIMPLE => 'EBT\\Message\\Simple\\SimpleMessage',
        self::MSTOREFORMAT => 'EBT\\Message\\MStoreFormat\\MStoreFormatMessage'
    );

    /**
     * @param string $type
     * @param array  $mapping In case mapping is provided, the default mapping is replaced.
     *                        In case you want to just add new message types you should:
     *                        $mapping = array_merge(MessageType::getMapping(), array(// new mesages));
     *                        $type = new MessageType($type, $mapping);
     */
    public function __construct($type, array $mapping = array())
    {
        if ($mapping !== array()) {
            static::$mapping = $mapping;
        }

        $this->type = (string) $type;

        // make sure the type/class exists
        $this->getClassName();
    }

    /**
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function getClassName()
    {
        $type = $this->type;
        if (!$this->has($type)) {
            throw new InvalidArgumentException(sprintf('Type "%s" not recognized', $type));
        }

        $mapping = static::getMapping();

        return $mapping[$type];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    protected function has($type)
    {
        $mapping = static::getMapping();

        return isset($mapping[$type]);
    }

    /**
     * @return array
     */
    public static function getMapping()
    {
        return static::$mapping;
    }
}
