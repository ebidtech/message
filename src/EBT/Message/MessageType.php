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
    /**
     * @var string
     */
    private $type;

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
        $typeCamel = ucfirst(Inflector::camelize($this->type));
        $className = sprintf('EBT\\Message\\%s\\%sMessage', $typeCamel, $typeCamel);
        if (!class_exists($className)) {
            throw new InvalidArgumentException(sprintf('Message class "%s" do not exists.', $className));
        }

        return $className;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->type;
    }
}
