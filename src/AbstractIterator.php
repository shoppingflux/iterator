<?php
namespace ShoppingFeed\Iterator;

abstract class AbstractIterator implements IteratorInterface
{
    /**
     * @var array|\Traversable
     */
    protected $items;

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return iterator_to_array($this);
    }
}
