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
 *
 * @extends Traversable<array-key, mixed>
 */
interface CountableTraversable extends Traversable, Countable
{
}
