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
	 *
	 * @return Vector<T> The numerically sorted vector
	 */
	 public function mergeSort<T>() : Vector<T>
 	{
 		return $this->mergeSortAsync(0, $this->vector->count()-1)->getWaitHandle()->join();
 	}

	/**
	 * Return the asynchronous Awaitable object for easily managing multiple
	 * asynchronous functions.
	 *
	 * @return Awaitable<Vector<T>>
	 */
	public function mergeSortAwaitable<T>() : Awaitable<Vector<T>>
	{
		return $this->mergeSortAsync(0, $this->vector->count()-1);
	}

	/**
	 * Async handler for MergeSort
	 *
	 * @access protected
	 * @param int $start	The key to start sorting at (Set by the recursion)
	 * @param int $end		The key to stop sorting at (Set by the recursion)
	 *
	 * @return Awaitable<Vector<T>> The wait handler containing the sorted vector
	 */
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

	/**
	 * Run the binary split asynchronously (awaited in mergeSortAsync)
	 *
	 * @access protected
	 * @param int $start			The key for the start of the parent sub-vector
	 * @param int $end				The key for the end of the parent sub-vector
	 *
	 * @return Awaitable<Vector<int>> The vector containing the positions of start, mid, end for the child sub-vectors
	 */
	protected async function mergeSortHalves(int $start, int $end) : Awaitable<Vector<int>>
	{
		$mid = (int) floor(($start+$end)/2);
		$this->mergeSortAsync($start, $mid);
		$this->mergeSortAsync($mid+1, $end);

		return Vector{$start, $mid, $end};
	}

	/**
	 * Perform the merge portion of MergeSort
	 *
	 * @access protected
	 * @param int $startIndex		The key for the beginning of the sub-vectors
	 * @param int $middleindex		The key right smack dab in the middle of the sub-vectors
	 * @param int $endIndex			The key at the end of the sub-vectors
	 *
	 * @return Vector<T> The merged and sorted vector
	 */
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

	/**
	 * Import data from both subvectors into the main vector.
	 *
	 * @param  Vector<T> $subvector1	The first subvector
	 * @param  Vector<T> $subvector2	The second subvector
	 * @param  int       $startIndex	The index of the main vector for which to start importing
	 * @return Vector<int>	A vector of indexes for the vector and subvectors
	 */
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

	/**
	 * Import data from a subvector into the main vector.
	 *
	 * @param  Vector<T> $subvector			The subvector to import
	 * @param  int       $firstVectorKey	The key on the vector to start importing data to
	 * @param  int       $firstSubVectorKey	The key on the subvector to start importing data from
	 * @return int	The last key on which data was imported
	 */
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

	/**
	 * Create sub vectors for the vector (This is why MergeSort does not work in-place.)
	 *
	 * @param  int       $startIndex	The index from which to start importing keys
	 * @param  int       $endIndex		The index for which to stop importing keys
	 * @return Vector<T>	The new subvector
	 */
	protected function generateSubVector<T>(int $startIndex, int $endIndex) : Vector<T>
	{
		$subVector	= Vector{};

		for ($k = $startIndex; $k <= $endIndex; $k++) {
			$subVector[] = $this->vector[$k];
		}

		return $subVector;
	}

	/**
	 * Compare two items to find out their mathematical equivelency.
	 *
	 * @param  T $item1	The first item to compare
	 * @param  T $item2	The second item to compare
	 * @return int	-1, 0, or 1 for less-than, equal-to, or greater-than respectively
	 */
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
