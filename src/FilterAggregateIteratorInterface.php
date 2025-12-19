<?php

namespace ShoppingFeed\Iterator;

interface FilterAggregateIteratorInterface
{
    /**
     * Register a processor that performs transformation operation.
     * The processor will receive items one by one, and are registered in FIFO mode
     *
     *
     * @return $this
     */
    public function addFilter(callable $filter);
}
