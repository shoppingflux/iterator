<?php

namespace ShoppingFeed\Iterator;

use ArrayIterator;
use Exception;
use InvalidArgumentException;
use Iterator;
use IteratorAggregate;

/**
 * @param iterable $iterable
 * @return Iterator
 * @throws InvalidArgumentException
 * @throws Exception
 */
function iterable_to_iterator(iterable $iterable): Iterator
{
    if ($iterable instanceof IteratorAggregate) {
        $iterable = $iterable->getIterator();
    }

    if (is_array($iterable)) {
        $iterable = new ArrayIterator($iterable);
    }

    if (! $iterable instanceof Iterator) {
        throw new InvalidArgumentException('Unable to convert given iterable to Iterator');
    }

    return $iterable;
}
