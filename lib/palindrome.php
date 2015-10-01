<?HH
/**
 * @author Rick Mac Gillis
 *
 * Various algorithms for working with palindromes
 */

namespace HackFastAlgos;

class Palindrome
{
	protected $originalText = null;
	protected $boundedText = null;

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
		// REFACTORING IN PROGRESS
		// http://articles.leetcode.com/2011/11/longest-palindromic-substring-part-ii.html
		$this->originalText = $text;
		$this->addTextBoundaries();
		$boundaryTextLen = strlen($this->boundedText);
		$palindromeLengths = [0];
		$centerPtr = 0;
		$rightPtr = 0;
		for ($i = 1; $i < $boundaryTextLen-1; $i++) {

			$iMirror = 2*$centerPtr - $i;

			$palindromeLengths[$i] = ($rightPtr > $i) ? min($rightPtr-$i, $palindromeLengths[$iMirror]) : 0;

			// Attempt to expand palindrome centered at $i
			while ($this->boundedText[$i + 1 + $palindromeLengths[$i]] == $this->boundedText[$i - 1 - $palindromeLengths[$i]]) {
				$palindromeLengths[$i]++;
			}

			// If the palindrome centered at $i expands past $rightPtr,
			// adjust center based on expanded palindrome.
			if ($i + $palindromeLengths[$i] > $rightPtr) {
				$centerPtr = $i;
				$rightPtr = $i + $palindromeLengths[$i];
			}

		}

		// Find the maximum element in $palindromeLengths.
		$maxLen = 0;
		$centerIndex = 0;
		for ($i = 1; $i < $boundaryTextLen-1; $i++) {
			if ($palindromeLengths[$i] > $maxLen) {
				$maxLen = $palindromeLengths[$i];
				$centerIndex = $i;
			}
		}

		$longest = substr($this->originalText, ($centerIndex - $maxLen - 1)/2, $maxLen);
		return $longest === false ? '' : $longest;

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
}
