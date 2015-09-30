<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various sorting algorithms optimized for speed.
 */

namespace HackFastAlgos;

class Sort
{
	/**
	 * SelectionSort sorts a vector in Theta(n^2) time (Quadratic time). This algorithm
	 * may be faster than MergeSort or QuickSort when sorting very small vectors consisting of
	 * around less than 10 elements. If you're sorting larger arrays, consider QuickSort or MergeSort.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Selection_sort
	 */
	public static function selectionSort<T>(Vector<T> $vector, Callable $callback) : Vector<T>
	{
		$vectorLen = $vector->count();

		// Loop through the vector
		for ($i = 0; $i < $vectorLen; $i++) {

			// Loop through the sub-vector to find any values less than $i, and swap them.
			for ($j = $i+1; $j < $vectorLen; $j++) {

				if ($callback($vector[$i], $vector[$j]) > 0) {

					$vector = static::swapValues($vector, $i, $j);

				}

			}

		}

		return $vector;
	}

	/**
	 * BubbleSort sorts a vector in quadratic time (Theta(n^2), and is less-efficient than
	 * InsertSort. It's still a well-known algorithm, though WikiPedia claims
	 * (@link https://en.wikipedia.org/wiki/Bubble_sort) that some researchers do not wish to have BubbleSort
	 * as part of the Computer Science curriculum. BubbleSort is part of this library as a benchmark.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Bubble_sort
	 */
	public static function bubbleSort<T>(Vector<T> $vector, Callable $compareCallback) : Vector<T>
	{
		$sortLen = $vector->count();
		while ($sortLen > 0) {

			$newLen = 0;

			for ($i = 1; $i < $sortLen; $i++) {

				if ($compareCallback($vector[$i-1], $vector[$i]) > 0) {

					static::swapValues($vector, $i-1, $i);
					$newLen = $i;

				}

			}

			$sortLen = $newLen;

		}

		return $vector;
	}

	/**
	 * InsertSort sorts a vector in quadratic time (Theta(n^2)), though it improves on
	 * SelectionSort. InsertSort is only useful for very small vectors. If you have a larger
	 * vector greater than around 10 elements, then try MergeSort or QuickSort.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Insertion_sort
	 */
	public static function insertSort<T>(Vector<T> $vector, Callable $compareCallback) : Vector<T>
	{
		$vectorLen = $vector->count();
		for ($i = 1; $i < $vectorLen; $i++) {

			$key = $vector[$i];
			$j = $i;

			while ($j > 0) {

				if ($compareCallback($vector[$j-1], $key) <= 0) {
					break;
				}

				$vector[$j] = $vector[$j-1];
				$j--;

			}

			$vector[$j] = $key;

		}

		return $vector;
	}

	/**
	 * Learn more @link https://en.wikipedia.org/wiki/Shellsort
	 * Operates in O(n^2) and Omega(n log^2 n) time.
	 */
	public static function shellSort(Vector<T> $vector, Callable $compareCallback) : Vector<T>
	{
		$gaps = static::getTokundaGaps($vector);
		while (!$gaps->isEmpty()){

			$gap = $gaps->pop();
			$vectorLen = $vector->count();
			for ($i = $gap; $i < $vectorLen; $i++) {

				$key = $vector[$i];

				for ($j = $i; $j >= $gap && $compareCallback($vector[$j-$gap], $key) > 0; $j -= $gap) {
		            $vector[$j] = $vector[$j - $gap];
		        }

				$vector[$j] = $key;

			}

		}

		return $vector;
	}

	/**
	 * Quick Sort works in big-O(n log n) time on average, though in the worst case, it
	 * will operate in big-Omega(n^2) time. This method aims for a 3 to 1 split by taking
	 * the median value of a random sampling of values from $array. As the sampling period
	 * takes extra work, set the $minArraySize to the smallest array to take a sampling from.
	 * Anything less than the specified array width will not using sampling.
	 */
	public static function quickSort(Vector<int> $vector, int $pivot = 0, int $numRandom = 9, int $minArraySize = 10) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Quicksort
		// Shuffle first
	}

	public static function quickSort3(Vector<int> $vector, int $pivot = 0, int $numRandom = 9, int $minArraySize = 10) : Vector<int>
	{
		// http://www.sorting-algorithms.com/static/QuicksortIsOptimal.pdf
		// Shuffle first
	}

	/**
	 * Heap sort is not a stable sorting method.
	 * Learn more @link https://en.wikipedia.org/wiki/Heapsort
	 */
	public static function heapSort<T>(Vector<T> $vector) : Vector<T>
	{
		$return = Vector{};
		$heap = new DataStructure\Heap();
		$heap->heapify($vector);
		$numItems = $heap->count();
		for ($i = 0; $i < $numItems; $i++) {
			$return[] = $heap->extract();
		}

		return $return;
	}

	public static function bucketSort(Vector<int> $vector, int $buckets) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Bucket_sort
	}

	public static function countingSort(Vector<int> $vector, int $maxValue) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Counting_sort
	}

	public static function radixSort(Vector<int> $vector) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Radix_sort
		// https://www.codingbot.net/2013/02/radix-sort-algorithm-and-c-code.html
	}

	/**
	 * Shuffle a vector with the Fisher-Yates shuffle. (It's slow as it uses a
	 * proper entropy source.)
	 *
	 * Runs in Theta(n) time.
	 */
	public static function fyShuffle<T>(Vector<T> $vector) : Vector<T>
	{
		$count = $vector->count();
		for ($i = 0; $i < $count-1; $i++) {

			$random = static::getRandomNumber($i+1, $count);
			$vector = static::swapValues($vector, $i, $random);

		}

		return $vector;
	}

	protected static function swapValues(Vector<int> $vector, int $indexA, int $indexB) : Vector<int>
	{
		$oldA = $vector[$indexA];
		$vector[$indexA] = $vector[$indexB];
		$vector[$indexB] = $oldA;

		return $vector;
	}

	/**
	 * Get the Shell Sort gaps using the Tokunda Algorithm.
	 *
	 * Learn more @link https://en.wikipedia.org/wiki/Shellsort#Gap_sequences
	 */
	protected static function getTokundaGaps(Vector<int> $vector) : Vector<int>
	{
		$count = $vector->count();
		$gaps = Vector{};
		$k = 1;
		$gap = 0;
		while ($gap < $count) {
			$gap = (int) ceil((9**$k - 4**$k) / (5*4**($k-1)));
			$k++;
			$gaps[] = $gap;
		}

		return $gaps;
	}

	/**
	 * Get a truely random number.
	 *
	 * Credits to @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	 */
	protected static function getRandomNumber(int $min, int $max) : int
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
