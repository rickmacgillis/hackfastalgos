<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various search algorithms.
 */

namespace HackFastAlgos;

class Search
{
	/**
	 * Operates in O(log n) or Omega(1) time.
	 * Learn more @link https://en.wikipedia.org/wiki/Binary_search_algorithm
	 */
	public static function binarySearch(Vector<int> $vector, int $find) : int
	{
		$start = 0;
		$end = $vector->count()-1;
		while ($end >= $start) {

			$middle = (int) floor($start + (($end-$start)/2));
			if ($vector[$middle] < $find) {
				$start = ++$middle;
			} else if ($vector[$middle] > $find) {
				$end = --$middle;
			} else {
				return $middle;
			}

		}

		return -1;
	}

	/**
	 * Operates in O(n) or Omega(1) time.
	 * Learn more @link https://en.wikipedia.org/wiki/Brute-force_search
	 */
	public static function bruteForceSearch(Vector<int> $vector, int $find) : int
	{
		foreach ($vector as $key => $value) {
			if ($value === $find) {
				return $key;
			}
		}

		return -1;
	}
}
