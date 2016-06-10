<?HH
/**
 * Hack Fast Algos
 *
 * Puzzle: Return all of the possible letter combinations for a telephone number.
 */

namespace HackFastAlgos\Interview;

class DialPad
{
	private array $lettersForNumbers = [
		0 => ['-'],
		1 => ['-'],
		2 => ['a', 'b', 'c'],
		3 => ['d', 'e', 'f'],
		4 => ['g', 'h', 'i'],
		5 => ['j', 'k', 'l'],
		6 => ['m', 'n', 'o'],
		7 => ['p', 'q', 'r', 's'],
		8 => ['t', 'u', 'v'],
		9 => ['w', 'x', 'y', 'z'],
	];

	private array $allCombinations = [];

	public function __construct(private string $phoneNumber)
	{
		$this->allCombinations = $this->listLetterCombinations();
	}

	public function getDialPadCombos() : array
	{
		return $this->allCombinations;
	}

	/**
	 * Operates in Theta(L^N) where N is the number of numbers in the telephone number, and L
	 * is the number of letters for a given number.
	 *
	 * Operates in Theta(L) space where L is the total number of possible combinations.
	 */
	private function listLetterCombinations(int $position = 0)
	{
		$totalDigits = strlen($this->phoneNumber);
		$currentNumber = $this->phoneNumber[(int) $position];
		$currentLetters = $this->lettersForNumbers[$currentNumber];

		if ($position < $totalDigits-1) {
			$laterCombinations = $this->listLetterCombinations($position+1);
		} else {
			return $currentLetters;
		}

		$currentCombinations = [];
		while (($laterCombination = array_pop($laterCombinations)) !== null) {

			for ($i = 0; $i < count($currentLetters); $i++) {
				$currentCombinations[] = $currentLetters[$i] . $laterCombination;
			}

		}

		return $currentCombinations;
	}
}
