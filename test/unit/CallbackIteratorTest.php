<?php

namespace ShoppingFeed\Iterator;

use ArrayIterator;
use IteratorAggregate;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use ShoppingFeed\Iterator\Exception\InvalidArgumentException;

#[Group('stdlib')]
#[Group('iterator')]
class CallbackIteratorTest extends TestCase
{
    private $instance;

    private $iterator;

    public function setUp(): void
    {
        $this->iterator = $this->createMock('\Iterator');
        $this->instance = new CallbackIterator(
            $this->iterator,
            [$this, 'toLowerCallback'],
        );
    }

    public function testConstructWithArray()
    {
        $instance = new CallbackIterator(
            ['element1', 'element2'],
            [$this, 'toLowerCallback'],
        );

        $this->assertInstanceOf(
            CallbackIterator::class,
            $instance,
        );
    }

    public function testConstructWithIteratorAggregate()
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

    public function testConstructWithInvalidValidator()
    {
        $this->expectException(InvalidArgumentException::class);

        new CallbackIterator(
            'invalidParameter',
            [$this, 'toLowerCallback'],
        );
    }

    public function testImplementsIteratorAggregate()
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic',
        );

        $this->assertInstanceOf(IteratorAggregate::class, $iterator);
    }

    public function testIteratesWithCallback()
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic',
        );

        $this->assertSame(['toto', 'titi'], $iterator->toArray());
    }

    public function toLowerCallback($element)
    {
        return strtolower($element);
    }

    public static function toLowerStatic($element)
    {
        return strtolower($element);
    }
}
