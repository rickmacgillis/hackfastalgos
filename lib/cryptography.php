<?HH
/**
 * @author Rick Mac Gillis
 *
 * Various cryptography related algorithms
 */

namespace HackFastAlgos;

class Cryptography
{
	/**
	 * Get a truely random number.
	 *
	 * Credits to @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	 */
	public static function getRandomNumber(int $min, int $max) : int
	{
		$range = $max - $min;
		if ($range <= 0) {
			return $min;
		}

		$log = log($range, 2);
		$lenInBytes = (int) ($log / 8) + 1;
		$lenInBits = (int) $log + 1;

		// set all lower bits to 1
		$filter = (int) (1 << $lenInBits) - 1;

		do {
		    $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($lenInBytes)));

			// discard irrelevant bits
		    $rnd = $rnd & $filter;
		} while ($rnd >= $range);

		return $min + $rnd;
	}
}
