<?php

namespace ShoppingFeed\Iterator;

use Countable;
use ReturnTypeWillChange;
use Traversable;

class FilterAggregateIterator extends AbstractIterator implements Countable, FilterAggregateIteratorInterface
{
    use FilterAggregateAwareTrait;

    /** @var callable[] */
    private array $filters = [];

    /**
     * @param iterable<mixed> $arrayOrTraversable
     */
    public function __construct(iterable $arrayOrTraversable)
    {
        $this->items = $arrayOrTraversable;
    }

    #[ReturnTypeWillChange]
    public function getIterator()
    {
        foreach ($this->items as $key => $item) {
            foreach ($this->filters as $filter) {
                $item = $filter($item);
            }

            yield $key => $item;
        }
    }

    public function count(): int
    {
        if ($this->items instanceof Traversable) {
            $this->items = iterator_to_array($this->items);
        }

        return count($this->items);
    }
}
