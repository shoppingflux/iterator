<?php
namespace ShoppingFeed\Iterator;

class FilterAggregateIterator extends AbstractIterator implements \Countable, FilterAggregateIteratorInterface
{
    use FilterAggregateAwareTrait;

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
     * @return \Generator
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        foreach ($this->items as $key => $item) {
            foreach ($this->filters as $filter) {
                $item = $filter($item);
            }

            yield $key => $item;
        }
    }

    /**
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return count($this->items);
    }
}
