<?php

namespace ShoppingFeed\Iterator;

use ArrayObject;
use PHPUnit\Framework\TestCase;

class FilterAggregateIteratorTest extends TestCase
{
    public function testCountCollection()
    {
        $this->assertCount(2, (new FilterAggregateIterator([1, 1])));
    }

    public function testToArrayReturnInternalStoredItems()
    {
        $array = [1, 1];
        $this->assertSame($array, (new FilterAggregateIterator(new ArrayObject($array)))->toArray());
    }

    public function testAddFilterIsFluent()
    {
        $instance = new FilterAggregateIterator([]);
        $this->assertSame($instance, $instance->addFilter('strtolower'));
    }

    public function testAddFiltersAreAppliedOnItems()
    {
        $instance = new FilterAggregateIterator([' sTr ']);
        $instance->addFilter('strtolower');
        $instance->addFilter('trim');
        $instance->addFilter('ucfirst');

        $item = $instance->toArray()[0];
        $this->assertSame('Str', $item);
    }

    public function testFiltersOnKeysAreApplied()
    {
        $expected = ['test' => 'TEST'];
        $instance = new FilterAggregateIterator($expected);

        $this->assertSame($expected, $instance->toArray());
    }
}
