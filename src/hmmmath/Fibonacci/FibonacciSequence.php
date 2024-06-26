<?php
namespace hmmmath\Fibonacci;

use ArrayAccess;
use Iterator;
use hmmmath\Exception\BadMethodCallException;


/**
 * @implements Iterator<int, FibonacciNumber>
 * @implements ArrayAccess<int, FibonacciNumber>
 */
class FibonacciSequence implements Iterator, ArrayAccess
{
    /** @var FibonacciNumber */
    private FibonacciNumber $number;

    /** @var FibonacciNumber */
    private FibonacciNumber $initial;

    /** @var int */
    private int $key = 0;

    public function __construct(int $start = 0, int $increment = 1)
    {
        $this->number = $this->initial = new FibonacciNumber($start, $increment);
    }

	/**
	 * @return int
	 */
	public function current(): int
    {
        return $this->number->getCurrent();
    }

	/**
	 * @return int
	 */
	public function key(): int
    {
        return $this->key;
    }

	/**
	 * @return bool
	 */
	public function valid(): bool
    {
        return true;
    }

	/**
	 * @return void
	 */
	public function rewind(): void
    {
        $this->key = 0;
        $this->number = $this->initial;
    }

	/**
	 * @return void
	 */
	public function next(): void
    {
        ++$this->key;
        $this->number = $this->number->getNext();
    }

	public function offsetExists($offset): bool // @codingStandardsIgnoreLine
    {
        return true;
    }

    public function offsetGet($offset): int // @codingStandardsIgnoreLine
    {
        $number = $this->initial;

        while ($offset-- > 0) {
            $number = $number->getNext();
        }

        return $number->getCurrent();
    }

	public function offsetSet($offset, $value): void // @codingStandardsIgnoreLine
    {
        throw BadMethodCallException::invalidMethod(__CLASS__, __FUNCTION__);
    }

    public function offsetUnset($offset): void // @codingStandardsIgnoreLine
    {
        throw BadMethodCallException::invalidMethod(__CLASS__, __FUNCTION__);
    }
}
