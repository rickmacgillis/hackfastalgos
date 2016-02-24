<?HH
/**
 * Hack Fast Algos
 *
 * Puzzle: Implement an algorithm to reverse a string.
 */

namespace HackFastAlgos\Interview;

class StringReverse
{
	public function __construct(private string $string){}

	/**
	 * Always operates in place in ~floor(n/2) time.
	 */
	public function reverse() : string
	{
		$stringLength = strlen($this->string);
		$left = 0;
		$right = $stringLength-1;
		while ($left < $right) {

			$this->swap($left, $right);
			$left++;
			$right--;

		}

		return $this->string;
	}

	private function swap(int $position1, int $position2)
	{
		$tmp = $this->string[$position1];
		$this->string[$position1] = $this->string[$position2];
		$this->string[$position2] = $tmp;
	}
}
