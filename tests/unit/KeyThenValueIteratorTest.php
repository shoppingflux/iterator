<?php
namespace ShoppingFeed\Iterator;

class KeyThenValueIteratorTest extends \PHPUnit_Framework_TestCase
{
    public function testIteratorProvidesTheKeyThenTheValue()
    {
        $instance = new KeyThenValueIterator(['foo' => 'bar', 'baz' => 'qux']);

        $this->assertSame(['foo', 'bar', 'baz', 'qux'], $instance->toArray());
    }

    public function testConstructorFailsIfInvalidValueIsProvided()
    {
        $this->expectException(Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Argument 1 passed to ShoppingFeed\Iterator\KeyThenValueIterator::__construct '.
            'must be an array or an instance of \Traversable'
        );

        new KeyThenValueIterator('foo');
    }
}
