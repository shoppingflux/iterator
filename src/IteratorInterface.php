<?php

namespace ShoppingFeed\Iterator;

use IteratorAggregate;

/**
 * @extends IteratorAggregate<int, mixed>
 */
interface IteratorInterface extends IteratorAggregate
{
    /**
     * @return array<mixed>
     */
    public function toArray(): array;
}
