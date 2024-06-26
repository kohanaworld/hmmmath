<?php
namespace hmmmath\Fibonacci;

use ArrayIterator;
use hmmmath\Exception\InvalidArgumentException;
use Traversable;
use LimitIterator;

class FibonacciFactory
{
	/**
	 * Create fibonacci sequence
	 *
	 * The sequence is infinite but the factory method optionally takes a third argument to limit the sequence. A fourth
	 * parameter can be passed to specify an offset for the sequence.
	 * @param int $start
	 * @param int $increment
	 * @param int $limit
	 * @param int $offset
	 * @return Traversable
	 */
    public static function sequence(int $start = 0, int $increment = 1, int $limit = 0, int $offset = 0): Traversable
    {
        $sequence = new FibonacciSequence($start, $increment);

        InvalidArgumentException::assertParameterType(3, 'integer', $limit, 'unsigned');
        InvalidArgumentException::assertParameterType(4, 'integer', $offset, 'unsigned');

        if ($limit > 0) {
            $sequence = new LimitIterator($sequence, $offset, $limit);
        }

        return $sequence;
    }
//@return ArrayIterator<int, FibonacciSequence>|LimitIterator<mixed, mixed,FibonacciSequence>
    /** Create fibonacci number */
    public static function number(int $start = 0, int $increment = 1): FibonacciNumber
    {
        return new FibonacciNumber($start, $increment);
    }

    private function __construct()
    {
    }

    private function __destruct()
    {
    }

    private function __clone()
    {
    }
}
