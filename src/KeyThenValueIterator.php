<?php

namespace ShoppingFeed\Iterator;

use InvalidArgumentException;
use ReturnTypeWillChange;
use Traversable;

/**
 * This iterator provides successively the given iterable key then its value, then the next key and value...
 */
class KeyThenValueIterator extends AbstractIterator
{
    public function __construct(mixed $iterable)
    {
        if (! is_array($iterable) && ! $iterable instanceof Traversable) {
            throw new InvalidArgumentException(sprintf(
                'Argument 1 passed to %s must be an array or an instance of \Traversable',
                __METHOD__,
            ));
        }

        $this->items = $iterable;
    }

    #[ReturnTypeWillChange]
    public function getIterator()
    {
        foreach ($this->items as $key => $value) {
            yield $key;
            yield $value;
        }
    }
}
