<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various selection algorithms
 */

namespace HackFastAlgos;

class Select
{
	public static function quickSelect(Vector<int> $vector, int $kthSmallest, int $left, int $right, int $pivot) : int
	{
		// https://en.wikipedia.org/wiki/Quickselect
		// Returns the index
	}

	public static function momSelect(Vector<int> $vector, int $kthSmallest, int $left, int $right, int $pivot) : int
	{
		// https://en.wikipedia.org/wiki/Median_of_medians
	}
}
