<?HH
/**
 * Hack Fast Algos
 *
 * Puzzle: Write an algorithm to iterate over the numbers 0 through 100 and output "Fizz" for
 * all multiples of 3. Output "Buzz" for all multiples of 5. Output "FizzBuzz" if a number is
 * a multiple of both 5 and 3. (Ex. 0:FizzBuzz 3:Fizz 5:Buzz ... 15:FizzBuzz)
 */

namespace HackFastAlgos\Interview;

class FizzBuzz
{
	public static function getFizzBuzz(int $start = 0, int $end = 100) : String
	{
		$fizzBuzz = '';
		for ($i = $start; $i <= $end; $i++) {

			if ($i % 3 === 0 || $i % 5 === 0) {
				$fizzBuzz .= $i.':';
			}

			if ($i % 3 === 0) {
				$fizzBuzz .= 'Fizz';
			}

			if ($i % 5 === 0) {
				$fizzBuzz .= 'Buzz';
			}

			if ($i % 3 === 0 || $i % 5 === 0) {
				$fizzBuzz .= ' ';
			}

		}

		return trim($fizzBuzz);
	}
}
