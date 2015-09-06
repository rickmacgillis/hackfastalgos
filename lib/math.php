<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various math algorithms optimized for speed.
 */

namespace HackFastAlgos;

class SearchException extends \Exception{}

class Search
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
	 * Signifies the desire to add the numbers. AKA Addition oriented math geek. :)
	 * @type int
	 */
	const int KSUM_ADD = 0;

	/**
	 * Signifies the desire to subtract the numbers.
	 * @type int
	 */
	const int KSUM_SUBTRACT = 1;

	/**
	 * Signifies the desire to multiply the numbers.
	 * @type int
	 */
	const int KSUM_MULTIPLY = 2;

	/**
	 * Signifies the desire to divide the numbers.
	 * @type int
	 */
	const int KSUM_DIVIDE = 3;

	public static function getFibonacci(int $nth) : int
	{
		// https://en.wikipedia.org/wiki/Fibonacci_number
	}

	public static function getFactorial(int $int) : int
	{
		// https://en.wikipedia.org/wiki/Factorial
	}

	public static function fromPolishNotation(string $math) : float
	{
		// https://en.wikipedia.org/wiki/Polish_notation
	}

	public static function karatsuba(float $num1, float $num2) : float
	{
		// https://en.wikipedia.org/wiki/Karatsuba_algorithm
	}

	public static function atkinFindPrimes<T>(int $lessThan, bool $onlyLast = false) : T
	{
		// https://en.wikipedia.org/wiki/Sieve_of_Atkin
		// Return a vector of all primes or an integer version of the last prime if $onlyLast is true.
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

	public function findTotalKSums(
		Vector<int> $vectors,
		int $total,
		int $numberOfNumbers,
		int $operation = static::KSUM_ADD
	) : Vector<Vector<int>>
	{
		/*
		 * https://en.wikipedia.org/wiki/3SUM
		 * Returns a vector containing a vector representation of every
		 * possibile combination equating to $total.
		 *
		 * Note: Make this method async as it could take a considerable
		 * amount of time.
		 */

		switch($numberOfNumbers) {

			case 1:
				// Check if $total exists in the vector.
				break;

			case 2:
				// 2Sum problem
				break;

			case 3:
				// 3Sum problem
				break;

			default:
				if ($numberOfNumbers <= 0) {
					throw new SearchException('The number of numbers to total must be at least one.');
				}

				// 4+ Sum problem
				break;

		}
	}
}
