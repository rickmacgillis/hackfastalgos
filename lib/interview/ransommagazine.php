<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Write an algorithm to see if all of the words in a ransom letter are contained in a magazine.
 */

namespace HackFastAlgos\Interview;

class RansomMagazine
{
	/**
	 * Operates in Theta(n) time where "n" is the number of characters in the ransom note.
	 */
	public static function magContainsRansom(string $magazine, string $ransomNote) : bool
	{
		$ransomLetterCounts = static::getLetterCounts($ransomNote);

		foreach ($ransomLetterCounts as $letter => $count) {

			$letterPos = 0;
			while ($count > 0) {

				$letterPos = strpos($magazine, $letter, $letterPos);
				if ($letterPos === false) {
					return false;
				}

				$count--;

			}

		}

		return true;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private static function getLetterCounts(string $ransomNote) : Map<string,int>
	{
		$ransomLength = strlen($ransomNote);
		$ransomLetterCounts = Map{};
		for ($i = 0; $i < $ransomLength; $i++) {

			$letter = $ransomNote[$i];
			if ($ransomLetterCounts->containsKey($letter) === false) {
				$ransomLetterCounts[$letter] = 1;
			} else {
				$ransomLetterCounts[$letter]++;
			}

		}

		return $ransomLetterCounts;
	}
}
