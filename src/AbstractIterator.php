<?php

namespace ShoppingFeed\Iterator;

use Traversable;

abstract class AbstractIterator implements IteratorInterface
{
    protected array|Traversable $items;

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return iterator_to_array($this);
    }
}
