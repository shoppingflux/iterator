<?php
namespace ShoppingFeed\Iterator;

interface IteratorInterface extends \IteratorAggregate
{
    /**
     * @return array
     */
    public function toArray();
}
