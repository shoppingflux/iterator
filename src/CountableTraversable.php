<?php

namespace ShoppingFeed\Iterator;

use Countable;
use Traversable;

/**
 * This interface can be used by any object which is countable AND traversable.
 *
 * @phpstan-type CountableIterable CountableTraversable|array
 *
 * CountableIterable is a composite type for any parameter which is countable
 * AND iterable.
 */
interface CountableTraversable extends Traversable, Countable
{

}
