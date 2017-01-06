<?php
namespace ShoppingFeed\Iterator;

class FilterAggregateIterator extends AbstractIterator implements \Countable
{
    /**
     * @var callable[]
     */
    private $filters = [];

    /**
     * @param array||Traversable $arrayOrTraversable
     */
    public function __construct($arrayOrTraversable)
    {
        $this->items = $arrayOrTraversable;
    }

    /**
     * @param callable $filter
     * @return $this
     */
    public function addFilter(callable $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @return \Generator
     */
    public function getIterator()
    {
        foreach ($this->items as $item) {
            foreach ($this->filters as $filter) {
                $item = $filter($item);
            }
            yield $item;
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }
}
