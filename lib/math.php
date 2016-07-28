<?HH
/**
 * Hack Fast Algos
 *
 * Implements various math algorithms optimized for speed.
 */

namespace HackFastAlgos;

class Math
{
	/**
	 * Operates in O(log n) time or Omega(1) time. (Due to Matrix exponentation)
	 */
	public static function getNthFibonacciNumber(int $nth) : int
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
}
