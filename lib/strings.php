<?HH
/**
 * @author Rick Mac Gillis
 *
 * Various algorithms involving strings
 */

namespace HackFastAlgos;

class Strings
{
	public static function getNeedlemanWunschScore(string $sequence1, string $squence2) : int
	{
		// https://en.wikipedia.org/wiki/Needleman%E2%80%93Wunsch_algorithm
	}

	public static function huffmanEncode(string $text) : string
	{
		// https://en.wikipedia.org/wiki/Huffman_coding
		// Implement it with two queues.
		// If we don't know the frequency of each character, then sort it with a heap.
	}

	public static function huffmanDecode(string $text) : string
	{
		// https://en.wikipedia.org/wiki/Huffman_coding
	}

	public static function findDialPadCombos(int $number) : Vector<string>
	{
		/*
		 * Take in a phone number (or any number) and return all of the possible word combinations
		 * in Theta(n log(n)) time. (Note: Until I've implemented it, the running time is theoretical.)
		 *
		 * Make one that returns the Async wait handler, and scrap this code.
		 */
		$dpadCobos = static::findDialPadCombosAsync($number);
		if ($returnWaitHandler) {
			return $dpadCobos;
		}

		return $dpadCobos->getWaitHandle()->join();
	}

	public static async function findDialPadCombosAsync(int $number) : Awaitable<Vector<string>>
	{
		// Recurse on the data in log3 to create a vector of strings for the given subproblem.
		// Merge the retrieved subproblem data into the data for the larger problem.
	}

	public static function kmpSearch()
	{
		// https://en.wikipedia.org/wiki/Knuth%E2%80%93Morris%E2%80%93Pratt_algorithm
	}

	/**
	 * Runs in Theta(n) time.
	 */
	public static function suffixArray(string $string) : Vector<string>
	{
		$stringLength = strlen($string);
		$suffixArray = Vector{$string};
		for ($i = 1; $i < $stringLength; $i++) {
			$suffixArray[] = substr($string, $i, $stringLength-$i);
		}

		return $suffixArray;
	}

	/**
	 * Runs in O(n) or Omega(1) time depending on if a prefix exists.
	 */
	public static function longestPrefix(string $string1, string $string2) : string
	{
		$string1Length = strlen($string1);
		$string2Length = strlen($string2);
		$shorterLength = $string1Length < $string2Length ? $string1Length : $string2Length;

		for ($i = 0; $i < $shorterLength && $string1[$i] === $string2[$i]; $i++) {}
		return substr($string1, 0, $i);
	}
}
