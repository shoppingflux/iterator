<?php

namespace ShoppingFeed\Iterator;

trait FilterAggregateAwareTrait
{
    private array $filters = [];

    public function addFilter(callable $filter): FilterAggregateIteratorInterface
    {
        $this->filters[] = $filter;

        return $this;
    }
}
