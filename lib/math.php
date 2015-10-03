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
