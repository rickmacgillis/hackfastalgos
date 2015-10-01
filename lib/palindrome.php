<?HH
/**
 * @author Rick Mac Gillis
 *
 * Various algorithms for working with palindromes
 */

namespace HackFastAlgos;

class Palindrome
{
	private $originalText = null;
	private $boundedText = null;
	private $palindromeLengths = [0];
	private $centerPtr = 0;
	private $rightPtr = 0;

	public function isPalindrome(string $text) : bool
	{
		$text = strtolower($text);
		$textLength = strlen($text);
		if ($textLength <= 1) {
			return true;
		}

		$leftPtr = 0;
		$rightPtr = $textLength-1;
		while ($leftPtr <= $rightPtr) {

			if ($text[$leftPtr] !== $text[$rightPtr]) {
				return false;
			}

			$leftPtr++;
			$rightPtr--;

		}

		return true;
	}

	public function findLongestPalindrome(string $text) : String
	{
		// Manachers Algorithm
		// http://articles.leetcode.com/2011/11/longest-palindromic-substring-part-ii.html
		$this->originalText = $text;
		$this->addTextBoundaries();
		$boundaryTextLen = strlen($this->boundedText);

		for ($i = 1; $i < $boundaryTextLen-1; $i++) {

			$this->setPalindromeStartingLengthForIndex($i);
			$this->incrementPalendromeLengthAtIndex($i);
			$this->retargetPointersForIndex($i);

		}

		return $this->getLongestPalindrome();

	}

	protected function addTextBoundaries()
	{
		if (empty($this->originalText)) {
			$this->boundedText = '^$';
		}

		$this->boundedText = '^';
		$textLen = strlen($this->originalText);
		for ($i = 0; $i < $textLen; $i++) {
			$this->boundedText .= "#".substr($this->originalText, $i, 1);
		}

		$this->boundedText .= '#$';
	}

	protected function setPalindromeStartingLengthForIndex(int $index)
	{
		if ($this->rightPtr > $index) {

			$indexMirror = $this->getIndexOppositeOf($index);
			$lengthOppositeOfIndex = $this->getLengthAtIndex($indexMirror);

			$distanceFromIndex = $this->rightPtr - $index;

			$this->palindromeLengths[$index] = min($distanceFromIndex, $lengthOppositeOfIndex);

		} else {
			$this->palindromeLengths[$index] = 0;
		}
	}

	protected function getLengthAtIndex(int $index) : int
	{
		return $this->palindromeLengths[$index];
	}

	protected function getIndexOppositeOf(int $index) : int
	{
		return 2*$this->centerPtr - $index;
	}

	protected function incrementPalendromeLengthAtIndex(int $index)
	{
		do {

			$leftCharIndex = $index - 1 - $this->getLengthAtIndex($index);
			$rightCharIndex = $index + 1 + $this->getLengthAtIndex($index);

			if ($this->boundedText[$leftCharIndex] === $this->boundedText[$rightCharIndex]) {
				$this->palindromeLengths[$index]++;
			} else {
				break;
			}

		} while (1);
	}

	protected function retargetPointersForIndex(int $index)
	{
		$rightSideOfPalendrome = $index + $this->getLengthAtIndex($index);
		if ($rightSideOfPalendrome > $this->rightPtr) {
			$this->centerPtr = $index;
			$this->rightPtr = $rightSideOfPalendrome;
		}
	}

	protected function getLongestPalindrome() : String
	{
		$maxLen = 0;
		$centerIndex = 0;
		$boundaryTextLen = strlen($this->boundedText);
		for ($i = 1; $i < $boundaryTextLen-1; $i++) {

			$palindromeLen = $this->getLengthAtIndex($i);
			if ($palindromeLen > $maxLen) {

				$maxLen = $palindromeLen;
				$centerIndex = $i;

			}

		}

		$palindromeStart = ($centerIndex - $maxLen - 1)/2;
		$longest = substr($this->originalText, $palindromeStart, $maxLen);
		return $longest === false ? '' : $longest;
	}
}
