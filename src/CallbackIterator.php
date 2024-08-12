<?php

namespace ShoppingFeed\Iterator;

use ArrayIterator;
use InvalidArgumentException;
use ReturnTypeWillChange;
use Traversable;

class CallbackIterator extends AbstractIterator
{
    /** @var ArrayIterator|Traversable<mixed> */
    private ArrayIterator|Traversable $iterator;

    /** @var callable */
    private $callback;

    public function __construct(mixed $arrayOrIterator, callable $callback)
    {
        if (is_array($arrayOrIterator)) {
            $arrayOrIterator = new ArrayIterator($arrayOrIterator);
        }

        if (! $arrayOrIterator instanceof Traversable) {
            throw new InvalidArgumentException(
                'Expecting an array or an instance of \Traversable',
            );
        }

        $this->iterator = $arrayOrIterator;
        $this->callback = $callback;
    }

    #[ReturnTypeWillChange]
    public function getIterator()
    {
        foreach ($this->iterator as $key => $item) {
            yield $key => call_user_func($this->callback, $item, $key);
        }
    }
}
