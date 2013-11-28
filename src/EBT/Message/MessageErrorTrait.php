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
 * MessageErrorTrait
 */
trait MessageErrorTrait
{
    /**
     * @var bool|string
     */
    protected $error = false;

    /**
     * @param bool|string $error
     */
    protected function setError($error)
    {
        $this->error = $error === false ? false : (string) $error;
    }

    /**
     * @return bool|string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return $this->getError() !== false;
    }
}
