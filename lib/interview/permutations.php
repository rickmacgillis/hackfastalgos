<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Find all of the permutations for a given string.
 * Learn more @link http://www.programmerinterview.com/index.php/recursion/permutations-of-a-string/
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
}
