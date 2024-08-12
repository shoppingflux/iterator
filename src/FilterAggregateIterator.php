<?php

namespace ShoppingFeed\Iterator;

use Countable;
use Generator;
use ReturnTypeWillChange;

class FilterAggregateIterator extends AbstractIterator implements Countable, FilterAggregateIteratorInterface
{
    use FilterAggregateAwareTrait;

    /** @var callable[] */
    private array $filters = [];

    public function __construct($arrayOrTraversable)
    {
        $this->items = $arrayOrTraversable;
    }

    #[ReturnTypeWillChange]
    public function getIterator(): Generator
    {
        foreach ($this->items as $key => $item) {
            foreach ($this->filters as $filter) {
                $item = $filter($item);
            }

            yield $key => $item;
        }
    }

    #[ReturnTypeWillChange]
    public function count(): int
    {
        return count($this->items);
    }
}
