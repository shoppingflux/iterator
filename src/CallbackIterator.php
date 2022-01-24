<?php
namespace ShoppingFeed\Iterator;

class CallbackIterator extends AbstractIterator
{
    /**
     * @var \Iterator
     */
    private $iterator;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @param $arrayOrIterator
     * @param $callback
     */
    public function __construct($arrayOrIterator, callable $callback)
    {
        if (is_array($arrayOrIterator)) {
            $arrayOrIterator = new \ArrayIterator($arrayOrIterator);
        }

        if (! $arrayOrIterator instanceof \Traversable) {
            throw new Exception\InvalidArgumentException(
                'Expecting an array or an instance of \Traversable'
            );
        }

        $this->iterator = $arrayOrIterator;
        $this->callback = $callback;
    }

    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        foreach ($this->iterator as $key => $item) {
            yield $key => call_user_func($this->callback, $item, $key);
        }
    }
}
