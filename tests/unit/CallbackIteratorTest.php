<?php
namespace ShoppingFeed\Iterator;

/**
 * @group stdlib
 * @group iterator
 */
class CallbackIteratorTest extends \PHPUnit_Framework_TestCase
{
    private $instance;

    private $iterator;

    public function setUp()
    {
        $this->iterator = $this->createMock('\Iterator');
        $this->instance = new CallbackIterator(
            $this->iterator,
            [$this, 'toLowerCallback']
        );
    }

    public function testConstructWithArray()
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

    public function testConstructWithIteratorAggregate()
    {
        $expected          = ['foo', 'bar', 'baz'];
        $iteratorAggregate = $this->createMock(\IteratorAggregate::class);
        $iteratorAggregate
            ->expects($this->once())
            ->method('getIterator')
            ->willReturn(new \ArrayIterator($expected));

        $instance = new CallbackIterator($iteratorAggregate, [$this, 'toLowerCallback']);
        $this->assertSame($expected, $instance->toArray());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructWithInvalidValidator()
    {
        new CallbackIterator(
            'invalidParameter',
            [$this, 'toLowerCallback']
        );
    }

    public function testImplementsIteratorAggregate()
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic'
        );

        $this->assertInstanceOf(\IteratorAggregate::class, $iterator);
    }

    public function testIteratesWithCallback()
    {
        $iterator = new CallbackIterator(
            ['TOTO', 'TITI'],
            self::class . '::toLowerStatic'
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
