<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Check if a string has all unique characters without the use of an additional data structure.
 */

namespace HackFastAlgos\Interview;

class UniqueChars
{
	/**
	 * Runs in O(n) or Omega(1) running time.
	 *
	 * When using a traditional array, the space complexity can go way up. Consider that ӯ equates to 54191.
	 * The benefit of not using a data structure is storage space for firmware devices. If storage space is
	 * not a concern, using a hashmap can significantly reduce the memory space complexity, and the algorithm
	 * implementation complexity. The time complexity remains asymptotically the same when
	 * using $unique[$char] = true.
	 */
	public static function areUnique(string $string) : bool
	{
		$unique = [];
		$stringLength = strlen($string);
		for ($i = 0; $i < $stringLength; $i++) {

			$index = static::charDec($string[$i]);

			if (!empty($unique[$index])) {
				return false;
			}

			$unique[$index] = true;

		}

		return true;
	}

	private static function charDec(string $char) : int
	{
		$charHex = unpack('H*', $char);
		return (int) base_convert($charHex[1], 16, 10);
	}
}
