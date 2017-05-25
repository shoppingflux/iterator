<?php
namespace ShoppingFeed\Iterator;

trait FilterAggregateAwareTrait
{
    /**
     * @var array
     */
    private $filters = [];

    /**
     * @inheritdoc
     */
    public function addFilter(callable $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }
}
