<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various math algorithms optimized for speed.
 */

namespace HackFastAlgos;

class MathNumberOfOperandsMustBeGreaterThanZeroException extends \Exception{}

class Math
{
	/**
	 * Signifies that we'll use the average to break the tie when evaluating the median of two equal heaps
	 * @var int MEDIANHEAP_AVG = 0
	 */
	const int MEDIANHEAP_AVG = 0;

	/**
	 * Signifies that we'll use the low value to break the tie when evaluating the median of two equal heaps
	 * @var int MEDIANHEAP_LOW = 1
	 */
	const int MEDIANHEAP_LOW = 1;

	/**
	 * Signifies that we'll use the high value to break the tie when evaluating the median of two equal heaps
	 * @var int MEDIANHEAP_HIGH = 2
	 */
	const int MEDIANHEAP_HIGH = 2;

	/**
	 * Get the nth Fibonnaci number.
	 *
	 * Operates in O(log n) time or Omega(1) time. (Due to Matrix exponentation)
	 *
	 * @param  int $nth
	 * @return int
	 */
	public static function getFibonacciNumber(int $nth) : int
	{
		// https://en.wikipedia.org/wiki/Fibonacci_number
	}

	public static function getFactorial(int $int) : int
	{
		// https://en.wikipedia.org/wiki/Factorial
	}

	public static function karatsuba(float $num1, float $num2) : float
	{
		// https://en.wikipedia.org/wiki/Karatsuba_algorithm
	}

	public static function atkinFindPrimes(int $lessThan) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Sieve_of_Atkin
	}

	public static function atkinFindGreatestPrime(int $lessThan) : int
	{
		// https://en.wikipedia.org/wiki/Sieve_of_Atkin
	}

	public static function findMedianHeap<T>(T $item, Callable $callback, int $highLowMedian = static::MEDIANHEAP_AVG) : T
	{
		/*
		 * Maintain two heaps (minHeap and maxHeap
		 * When an item is added
		 * 		Check if the item belongs on the minHeap or maxHeap, then add it in.
		 * 		Keep the heaps balanced by extracting the extra value from one heap
		 * 			and placing it on the other heap.
		 *
		 * Return the median
		 * 		In case of a perfectly balanced dual heap, use $highLowMedian to determine which median to return
		 */
	}

	public static function findTotal2Sums(Vector<int> $vectors, int $total) : Vector<Vector<int>>
	{
		// https://en.wikipedia.org/wiki/3SUM
	}

	public static function findTotal3Sums(Vector<int> $vectors, int $total) : Vector<Vector<int>>
	{
		// https://en.wikipedia.org/wiki/3SUM
	}

	public static function findTotalKSums(Vector<int> $vectors, int $total, int $numberOfNumbers) : Vector<Vector<int>>
	{
		/*
		 * https://en.wikipedia.org/wiki/3SUM
		 * Returns a vector containing a vector representation of every
		 * possibile combination equating to $total.
		 *
		 * Note: Make this method async as it could take a considerable
		 * amount of time.
		 */

		if ($numberOfNumbers <= 0) {
 			throw new MathNumberOfOperandsMustBeGreaterThanZeroException();
 		}
	}
}
