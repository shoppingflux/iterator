<?php

namespace ShoppingFeed\Iterator;

use ArrayObject;
use PHPUnit\Framework\TestCase;

class FilterAggregateIteratorTest extends TestCase
{
    public function testCountCollection(): void
    {
        $this->assertCount(2, (new FilterAggregateIterator([1, 1])));
    }

    public function testToArrayReturnInternalStoredItems(): void
    {
        $array = [1, 1];
        $this->assertSame($array, (new FilterAggregateIterator(new ArrayObject($array)))->toArray());
    }


    public function testAddFilterIsFluent(): void
    {
        $instance = new FilterAggregateIterator([]);
        $this->assertSame($instance, $instance->addFilter('strtolower'));
    }

    public function testAddFiltersAreAppliedOnItems(): void
    {
        $instance = new FilterAggregateIterator([' sTr ']);
        $instance->addFilter('strtolower');
        $instance->addFilter('trim');
        $instance->addFilter('ucfirst');

        $item = $instance->toArray()[0];
        $this->assertSame('Str', $item);
    }

    public function testFiltersOnKeysAreApplied(): void
    {
        $expected = ['test' => 'TEST'];
        $instance = new FilterAggregateIterator($expected);

        $this->assertSame($expected, $instance->toArray());
    }
}
