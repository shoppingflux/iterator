<?php

namespace ShoppingFeed\Iterator;

use IteratorAggregate;

interface IteratorInterface extends IteratorAggregate
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;
}
