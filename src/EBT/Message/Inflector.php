<?php

/*
 * This file is a part of the Redis queue.
 *
 * (c) 2013 Emailbidding
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\Message;

use Doctrine\Common\Inflector\Inflector as DoctrineInflector;

/**
 * Inflector
 */
class Inflector
{
    /**
     * Uses Doctrine inflector camelize() under the hood, with the difference that uses ucfirst() in the return of
     * Doctrine camelize()
     *
     * @param string $word
     *
     * @return string
     */
    public static function camelize($word)
    {
        return ucfirst(DoctrineInflector::camelize($word));
    }
}
