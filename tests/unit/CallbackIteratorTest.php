<?php

namespace ShoppingFeed\Iterator;

use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @group stdlib
 * @group iterator
 */
class CallbackIteratorTest extends TestCase
{
    public function testConstructWithArray(): void
    {
        $instance = new CallbackIterator(
            ['element1', 'element2'],
            [$this, 'toLowerCallback']
        );

        $this->assertInstanceOf(
            CallbackIterator::class,
            $instance
        );
    }

    public function testConstructWithIteratorAggregate(): void
    {
        $expected          = ['foo', 'bar', 'baz'];
        $iteratorAggregate = $this->createMock(IteratorAggregate::class);
        $iteratorAggregate
            ->expects($this->once())
            ->method('getIterator')
            ->willReturn(new ArrayIterator($expected));

        $instance = new CallbackIterator($iteratorAggregate, [$this, 'toLowerCallback']);
        $this->assertSame($expected, $instance->toArray());
    }

    public function testConstructWithInvalidValidator(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CallbackIterator(
            'invalidParameter',
            [$this, 'toLowerCallback']
        );
    }

    public function testImplementsIteratorAggregate(): void
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic'
        );

        $this->assertInstanceOf(IteratorAggregate::class, $iterator);
    }

    public function testIteratesWithCallback(): void
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic'
        );

        $this->assertSame(['toto', 'titi'], $iterator->toArray());
    }

    public function toLowerCallback($element): string
    {
        return strtolower($element);
    }

    public static function toLowerStatic($element): string
    {
        return strtolower($element);
    }
}
