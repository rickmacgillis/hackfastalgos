<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: A vector of consecutive integers is rotated such that the numbers restart
 * counting somewhere in the vector. Find the key at which the numbers begin counting.
 * (Ex. In Vector{6,7,8,9,0,1,2,3,4,5}, the reset point is 4, as 0 is the lowest number.)
 */

namespace HackFastAlgos\Interview;

class ResetVectorResetPointNotFoundException extends \Exception{}

class ResetVector
{
	public static function findResetPointInRangeVector(Vector<int> $vector, int $start = 0, ?int $end = null) : int
	{
		$end = $end === null ? $vector->count()-1 : $end;
		$middle = (int) floor($start + ($end - $start)/2);

		if ($vector[$middle] > $vector[$end]) {
			return static::findResetPointInRangeVector($vector, $middle+1, $end);
		}

		if ($vector[$middle] < $vector[$end]) {

			if ($vector[$middle-1] > $vector[$end]) {
				return $middle;
			}

			return static::findResetPointInRangeVector($vector, $start, $middle-1);
		}

		return $middle;
	}
}
