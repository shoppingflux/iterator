<?php

namespace ShoppingFeed\Iterator;

use ArrayIterator;
use InvalidArgumentException;
use Iterator;
use IteratorAggregate;

/**
 * @param iterable<mixed> $iterable
 * @throws InvalidArgumentException|\Exception
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
