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
use Doctrine\Common\Inflector\Inflector;

/**
 * MessageType
 */
class MessageType
{
    const SIMPLE = 'simpe';
    const MSTOREFORMAT = 'mstoreformat';

    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     *
     * @throws InvalidArgumentException
     */
    public function __construct($type)
    {
        $this->type = (string) $type;

        // make sure the class exists
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

        $mapping = $this->getMapping();

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
        $mapping = $this->getMapping();

        return isset($mapping[$type]);
    }

    /**
     * @return array
     */
    public function getMapping()
    {
        return array(
            static::SIMPLE => 'EBT\\Message\\Simple\\SimpleMessage',
            static::MSTOREFORMAT => 'EBT\\Message\\MStoreFormat\\MStoreFormatMessage'
        );
    }
}
