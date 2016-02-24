<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of various Radix Sort sorting algorithms
 *
 * Learn more
 * @link https://en.wikipedia.org/wiki/Radix_sort
 * @link http://algs4.cs.princeton.edu/51radix/LSD.java.html
 * @link http://algs4.cs.princeton.edu/51radix/MSD.java.html
 */

namespace HackFastAlgos;

class RadixSort
{
	public function __construct(private Vector<string> $vector){}

	public function sortAsciiLsd()
	{
		$itemLength = strlen($this->vector[0]);
		for ($i = $itemLength-1; $i >= 0; $i--) {

			$countingSort = new \HackFastAlgos\CountingSort($this->vector, $i);
			$this->vector = $countingSort->sortAscii();

		}

		return $this->vector;
	}

	public function sortIntegerLsd()
	{

	}

	public function sortAsciiMsd()
	{

	}

	public function sortIntegerMsd()
	{

	}
}
