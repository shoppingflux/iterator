<?php
namespace ShoppingFeed\Iterator;

/**
 * This iterator provides successively the given iterable key then its value, then the next key and value...
 */
class KeyThenValueIterator extends AbstractIterator
{
    /**
     * @param array|\Traversable $iterable
     */
    public function __construct($iterable)
    {
        if (!is_array($iterable) && !$iterable instanceof \Traversable) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Argument 1 passed to %s must be an array or an instance of \Traversable',
                __METHOD__
            ));
        }

        $this->items = $iterable;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        foreach ($this->items as $key => $value) {
            yield $key;
            yield $value;
        }
    }
}
