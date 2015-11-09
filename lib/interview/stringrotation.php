<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Write code to check if a string is a rotation of a second string.
 */

namespace HackFastAlgos\Interview;

class StringRotation
{
	public static function isRotationOf(string $rotated, string $unrotated) : bool
	{
		$doubleConcat = $rotated.$rotated;
		$unrotatedPosition = strpos($doubleConcat, $unrotated);
		if ($unrotatedPosition === false) {
			return false;
		}

		$firstHalf = substr($doubleConcat, $unrotatedPosition+strlen($unrotated));
		$lastHalf = substr($doubleConcat, 0, $unrotatedPosition);

		return $firstHalf.$lastHalf === $unrotated;
	}
}
