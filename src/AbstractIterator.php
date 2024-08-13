<?php

namespace ShoppingFeed\Iterator;

abstract class AbstractIterator implements IteratorInterface
{
    /** @var iterable<mixed> */
    protected iterable $items;

    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}
