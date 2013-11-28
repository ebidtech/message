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
 * MessageStoreFormat
 */
class MessageStoreFormat
{
    const JSON = 'json';
    const SERIALIZE = 'serialize';
    const PLAIN = 'plain';

    /**
     * @var string
     */
    private $format;

    /**
     * @var array
     */
    private $recognizedFormats = array(self::JSON, self::SERIALIZE, self::PLAIN);

    /**
     * @param mixed $format
     *
     * @throws InvalidArgumentException
     */
    public function __construct($format)
    {
        $format = (string) $format;
        if (!$this->isRecognized($format)) {
            throw new InvalidArgumentException(sprintf('The payload store format "%s" is not recognized.', $format));
        }

        $this->format = $format;
    }

    /**
     * @return string
     */
    protected function get()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }

    /**
     * @return bool
     */
    public function isJson()
    {
        return $this->get() == self::JSON;
    }

    /**
     * @return bool
     */
    public function isSerialize()
    {
        return $this->get() == self::SERIALIZE;
    }

    /**
     * @return bool
     */
    public function isPlain()
    {
        return $this->get() == self::PLAIN;
    }

    /**
     * @param string $format
     *
     * @return bool
     */
    private function isRecognized($format)
    {
        return in_array((string) $format, $this->recognizedFormats);
    }
}
