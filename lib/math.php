<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various math algorithms optimized for speed.
 */

namespace HackFastAlgos;

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
	
	public static function fibonacci(int $nth) : int
	{
		// https://en.wikipedia.org/wiki/Fibonacci_number
	}
	
	public static function factorial(int $int) : int
	{
		// https://en.wikipedia.org/wiki/Factorial
	}
	
	public static function polishNotation(string $math) : float
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
		// Return a vector of all primes or an integer version of the last prime if true === $onlyLast
	}
	
	public static function medianHeap<T>(T $item, Callable $callback, int $highLowMedian = static::MEDIANHEAP_AVG) : T
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
	
	public function twoSum(Vector<int> $vector, int $total) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/3SUM
		// Returns the numbers that total $total
	}
	
	public function threeSum(Vector<int> $vector, int $total) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/3SUM
		// Returns the numbers that total $total
	}
}
