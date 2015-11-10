<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle 1: Find all of the permutations for a given string.
 * Learn more @link http://www.programmerinterview.com/index.php/recursion/permutations-of-a-string/
 *
 * Puzzle 2: Check if one string is a permutation of another string.
 */

namespace HackFastAlgos\Interview;

class Permutations
{
	private array<bool> $used = [];
	private Vector<string> $permutations = Vector{};

	public function __construct(private string $string) {}

	public function permute(?int $stringLen = null, string $buffer = null, int $charIndex = 0)
	{
		$stringLen = $stringLen === null ? strlen($this->string) : $stringLen;

		if ($charIndex === $stringLen) {
			$this->permutations[] = $buffer;
			return;
		}

		for ($i = 0; $i < $stringLen; $i++) {

			if (array_key_exists($i, $this->used) && $this->used[$i] === true) {
				continue;
			}

			$buffer .= $this->string[$i];
			$this->used[$i] = true;
			$this->permute($stringLen, $buffer, $charIndex+1);
			$this->used[$i] = false;
			$buffer = substr($buffer, 0, strlen($buffer)-1);

		}
	}

	public function getPermutation() : Vector<string>
	{
		return $this->permutations;
	}

	public function isAPermutationOf(string $secondString) : bool
	{
		$stringLength = strlen($this->string);
		if ($stringLength !== strlen($secondString)) {
			return false;
		}

		$containedChars = $this->getCharCountArray();

		for ($i = 0; $i < $stringLength; $i++) {

			$char = $secondString[$i];
			if (empty($containedChars[$char])) {
				return false;
			} elseif ($containedChars[$char] === 1) {
				unset($containedChars[$char]);
			} else {
				$containedChars[$char]--;
			}

		}

		return empty($containedChars);
	}

	private function getCharCountArray() : array<string, int>
	{
		$containedChars = [];
		$stringLength = strlen($this->string);
		for ($i = 0; $i < $stringLength; $i++) {

			$char = $this->string[$i];
			if (empty($containedChars[$char])) {
				$containedChars[$char] = 1;
			} else {
				$containedChars[$char]++;
			}

		}

		return $containedChars;
	}
}
