<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of various substring search methods
 *
 * Learn more:
 * @link http://algs4.cs.princeton.edu/53substring/Brute.java.html
 * @link https://en.wikipedia.org/wiki/Knuth%E2%80%93Morris%E2%80%93Pratt_algorithm
 * @link http://algs4.cs.princeton.edu/53substring/KMP.java.html
 * @link http://algs4.cs.princeton.edu/53substring/KMPplus.java.html
 * @link https://en.wikipedia.org/wiki/Deterministic_finite_automaton
 * @link https://en.wikipedia.org/wiki/Nondeterministic_finite_automaton
 * @link http://algs4.cs.princeton.edu/53substring/BoyerMoore.java.html
 */

namespace HackFastAlgos;

class SubStringStringNotFoundException extends \Exception{}

class SubString
{
	private array $dfa = [];
	private array $nfa = [];
	private array $rightMost = [];

	public function __construct(private string $needle, private string $haystack){}

	/**
	 * Operates in O(M*N) or Omega(N) time where M is the length of the haystack, and N is the length of the needle.
	 */
	public function bruteForceVersion1() : int
	{
		$haystackLength = strlen($this->haystack);
		$needleLength = strlen($this->needle);
		for ($i = 0; $i < $haystackLength; $i++) {

			if ($this->haystack[$i] === $this->needle[0]) {

				for ($j = 0; $j < $needleLength; $j++) {

					if ($this->haystack[$i+$j] !== $this->needle[$j]) {
						break;
					}

					if ($j === $needleLength-1) {
						return $i;
					}

				}

			}

		}

		$this->throwStringNotFoundException();
	}

	/**
	 * Operates in O(M*N) or Omega(N) time where M is the length of the haystack, and N is the length of the needle.
	 */
	public function bruteForceVersion2() : int
	{
		$haystackLength = strlen($this->haystack);
		$needleLength = strlen($this->needle);
		for ($i = 0, $j = 0; $i < $haystackLength && $j < $needleLength; $i++) {

			if ($this->haystack[$i] === $this->needle[$j]) {
				$j++;
			} else if ($j > 0) {
				$i -= $j;
				$j = 0;
			}

		}

		if ($j === $needleLength) {
			return $i - $j;
		}

		$this->throwStringNotFoundException();
	}

	/**
	 * Operates in O(M*N+R*N) or Omega(R*N) time where M is the length of the haystack, N is the length of the needle,
	 * and R is the number of unique characters in the needle.
	 */
	public function kmpSearch() : int
	{
		$this->calculateDfa();
		$haystackLength = strlen($this->haystack);
		$needleLength = strlen($this->needle);
		for ($i = 0, $j = 0; $i < $haystackLength && $j < $needleLength; $i++) {
			$char = $this->haystack[$i];
			$j = $this->getRestartState($char, $j);
		}

		if ($j === $needleLength) {
			return $i-$needleLength;
		}

		$this->throwStringNotFoundException();
	}

	/**
	 * Operates in O(N^2) or Omega(N) time.
	 */
	public function kmpSearchImproved() : int
	{
		$this->calculateNfa();
		$haystackLength = strlen($this->haystack);
		$needleLength = strlen($this->needle);
		for (
			$haystackIndex = 0, $needleIndex = 0;
			$haystackIndex < $haystackLength && $needleIndex < $needleLength;
			$haystackIndex++
		) {

			while ($needleIndex >= 0 && $this->haystack[$haystackIndex] !== $this->needle[$needleIndex]) {
				$needleIndex = $this->nfa[$needleIndex];
			}
			$needleIndex++;

		}

		if ($needleIndex === $needleLength) {
			return $haystackIndex - $needleLength;
		}

		$this->throwStringNotFoundException();
	}

	/**
	 * Operates in O(M+N) or Omega(N) time where M is the haystack size, and N is the needle size.
	 */
	public function boyerMooreSearch() : int
	{
		$this->calculateRightMostPositions();
		$haystackLength = strlen($this->haystack);
		$needleLength = strlen($this->needle);
		for ($skip = 0, $haystackIndex = 0; $haystackIndex < $haystackLength; $haystackIndex += $skip) {

			$skip = 0;
			for ($needleIndex = $needleLength-1; $needleIndex >= 0; $needleIndex--) {

				$haystackChar = $this->haystack[$haystackIndex + $needleIndex];
				if ($this->needle[$needleIndex] !== $haystackChar) {

					$rightMostOffset = empty($this->rightMost[$haystackChar]) ? 1 : $this->rightMost[$haystackChar];
					$skip = max(1, $needleIndex - $rightMostOffset);
					break;

				}

			}

			if ($skip === 0) {
				return $haystackIndex;
			}

		}

		$this->throwStringNotFoundException();
	}

	private function throwStringNotFoundException()
	{
		throw new SubStringStringNotFoundException($this->needle);
	}

	/**
	 * Space-efficient Deterministic Finate Automaton (DFA)
	 * My version omits the elements pointing to 0. It operates in Theta(R*N) where R is the
	 * radix. [Number of characters] and N is the length of the needle. To find the radix, this
	 * algorithms adds unique chars to the $this->dfa so as not to add memory overhead. It them
	 * counts the number of entries.
	 *
	 * The benefit of KMP is that once it's calculated the DFA, it won't have to always start over
	 * from the beginning of the needle while searching. That's critical in long haystacks and
	 * potentially long needles.
	 */
	private function calculateDfa()
	{
		$this->dfa = [];
		$this->addUniqueCharsToDfa();
		$radix = count($this->dfa);
		$needleLength = strlen($this->needle);
		$this->setRestartState($this->getCharAt(0), 0, 1);
		for ($pointer = 0, $column = 1; $column < $needleLength; $column++) {

			foreach ($this->dfa as $char => $array) {

				$pointerState = $this->getRestartState($char, $pointer);
				if ($pointerState !== 0) {
					$this->setRestartState($char, $column, $pointerState);
				}

			}

			$char = $this->getCharAt($column);
			$this->setRestartState($char, $column, $column+1);
			$pointer = $this->getRestartState($char, $pointer);

		}
	}

	/**
	 * Operates in Theta(N) time where N is the length of the needle.
	 */
	private function addUniqueCharsToDfa()
	{
		$needleLength = strlen($this->needle);
		for ($i = 0; $i < $needleLength; $i++) {
			$this->dfa[$this->getCharAt($i)] = [];
		}
	}

	private function getCharAt(int $index) : string
	{
		return $this->needle[$index];
	}

	private function getRestartState(string $char, int $column) : int
	{
		return empty($this->dfa[$char][$column]) ? 0 : $this->dfa[$char][$column];
	}

	private function setRestartState(string $char, int $column, int $state)
	{
		$this->dfa[$char][$column] = $state;
	}

	/**
	 * Operates in O(N^2) or Omega(N) time.
	 */
	private function calculateNfa()
	{
		$this->nfa = [];
		$needleLength = strlen($this->needle);
		$this->nfa[0] = -1;
		for (
			$restartState = 0, $needlePointer = 1;
			$needlePointer < $needleLength;
			$needlePointer++
		) {

			if ($this->getCharAt($needlePointer) !== $this->getCharAt($restartState)) {
				$this->nfa[$needlePointer] = $restartState;
			} else {
				$this->nfa[$needlePointer] = $this->nfa[$restartState];
			}

			while ($restartState >= 0 && $this->getCharAt($needlePointer) !== $this->getCharAt($restartState)) {
				$restartState = $this->nfa[$restartState];
			}
			$restartState++;

		}
	}

	/**
	 * Operates in Theta(N) time.
	 */
	private function calculateRightMostPositions()
	{
		$this->rightMost;
		$needleLength = strlen($this->needle);
		for ($i = 0; $i < $needleLength; $i++) {
			$this->rightMost[$this->getCharAt($i)] = $i;
		}
	}
}
