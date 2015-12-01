<?HH
/**
 * @author Rick Mac Gillis
 *
 * Various cryptography related algorithms
 *
 * Learn more
 * @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
 * @link https://en.wikipedia.org/wiki/Wagstaff_prime
 * @link https://en.wikipedia.org/wiki/Horner%27s_method
 */

namespace HackFastAlgos;

class Cryptography
{
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

	/**
	 * Horner hash man says imPredictable.
	 */
	public static function asciiHornerHash(string $string) : int
	{
		$totalAscii = 256;
		$bitPrime31 = 715827883;
		$hash = 1;
		$stringLength = strlen($string);
		for ($i = 0; $i < $stringLength; $i++) {
			$hash = ($totalAscii * $hash + ord($string[$i])) % $bitPrime31;
		}

		return $hash;
	}
}
