<?php

namespace ShoppingFeed\Iterator;

use IteratorAggregate;

interface IteratorInterface extends IteratorAggregate
{
    /**
     * @return array
     */
    public function toArray();
}
