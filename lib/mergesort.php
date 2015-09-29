<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Merge Sort
 * Learn more @link https://en.wikipedia.org/wiki/Merge_sort
 */

namespace HackFastAlgos;

class MergeSort
{
	public function __construct(protected Vector<T> $vector = Vector{}){}

	/**
	 * MergeSort runs in Big-Theta(n log n) time and is suitable for large datasets. It does not
	 * work in place, so if memory is an issue, consider QuickSort. This implementation of MergeSort
	 * takes advantage of the asynchronous features Hack provides, such that the child-nodes
	 * of the binary recursion tree are recursed at the same time.
	 */
	 public function mergeSort<T>() : Vector<T>
 	{
 		return $this->mergeSortAsync(0, $this->vector->count()-1)->getWaitHandle()->join();
 	}

	public function mergeSortAwaitable<T>() : Awaitable<Vector<T>>
	{
		return $this->mergeSortAsync(0, $this->vector->count()-1);
	}

	protected async function mergeSortAsync<T>(int $start, int $end) : Awaitable<Vector<T>>
	{
		if ($start < $end) {

			/*
			 * We need to wait for any children to do the splits so merge() will have everything it
			 * needs at this recursion level.
			 */
			$halves = await $this->mergeSortHalves($start, $end);
			return $this->merge($halves[0], $halves[1], $halves[2]);

		}

		return $this->vector;
	}

	protected async function mergeSortHalves(int $start, int $end) : Awaitable<Vector<int>>
	{
		$mid = (int) floor(($start+$end)/2);
		$this->mergeSortAsync($start, $mid);
		$this->mergeSortAsync($mid+1, $end);

		return Vector{$start, $mid, $end};
	}

	protected function merge<T>(int $startIndex, int $middleindex, int $endIndex) : Vector<T>
	{
		$left	= $this->generateSubVector($startIndex, $middleindex);
		$right	= $this->generateSubVector($middleindex+1, $endIndex);

		// Sort the vector by combining both sub-vectors
		list($leftVectorStart, $rightVectorStart, $vectorStart) = $this->importDataFromBothSubVectors($left, $right, $startIndex);

		// Always pull from the left subarray first so the algorithm is stable for multisorting.
		$vectorStart = $this->importDataFromSubVector($left, $vectorStart, $leftVectorStart);
		$vectorStart = $this->importDataFromSubVector($right, $vectorStart, $rightVectorStart);

		return $this->vector;
	}

	protected function importDataFromBothSubVectors<T>(Vector<T> $subvector1, Vector<T> $subvector2, int $startIndex) : Vector<int>
	{
		$i = $j = 0;
		$k = $startIndex;

		while ($i < $subvector1->count() && $j < $subvector2->count()) {

			// Always pull from the left subarray first so the algorithm is stable for multisorting.
			if ($this->compare($subvector1[$i], $subvector2[$j]) > 0) {
				$this->vector[$k++] = $subvector2[$j++];
			} else {
				$this->vector[$k++] = $subvector1[$i++];
			}

		}

		return Vector{$i, $j, $k};
	}

	protected function importDataFromSubVector<T>(Vector<T> $subvector, int $firstVectorKey, int $firstSubVectorKey) : int
	{
		$j = $firstSubVectorKey;
		$k = $firstVectorKey;

		while ($j < $subvector->count()) {

			$this->vector[$k] = $subvector[$j];
			$j++;
			$k++;

		}

		return $k;
	}

	protected function generateSubVector<T>(int $startIndex, int $endIndex) : Vector<T>
	{
		$subVector	= Vector{};

		for ($k = $startIndex; $k <= $endIndex; $k++) {
			$subVector[] = $this->vector[$k];
		}

		return $subVector;
	}

	protected static function compare<T>(T $item1, T $item2) : int
	{
		if ($item1 > $item2) {
			return 1;
		} elseif ($item1 < $item2){
			return -1;
		} else {
			return 0;
		}
	}
}
