<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various sorting algorithms optimized for speed.
 */

namespace HackFastAlgos;

class Sort
{
	/**
	 * SelectionSort sorts an integer vector in Theta(n^2) time (Quadratic time). This algorithm
	 * may be faster than MergeSort or QuickSort when sorting very small vectors consisting of
	 * around less than 10 elements. If you're sorting larger arrays, consider QuickSort or MergeSort.
	 * 
	 * @param Vector<int> $vector The integer vector to sort from lowest to highest value
	 * 
	 * @return Vector<int> The sorted integer vector
	 */
	public static function selectionSort(Vector<int> $vector) : Vector<int>
	{
		$vectorLen = count($vector);
		
		for ($i = 0; $i < $vectorLen; $i++) {
			
			for ($j = $i+1; $j < $vectorLen; $j++) {
				
				if ($vector[$i] > $vector[$j]) {
					
					$oldi = $vector[$i];
					$vector[$i] = $vector[$j];
					$vector[$j] = $oldi;
					
				}
				
			}
			
		}
		
		// https://en.wikipedia.org/wiki/Selection_sort
		return $vector;
	}
	
	public static function insertSort(Vector<int> $vector) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Insertion_sort
	}
	
	public static function mergeSort(Vector<int> $vector, int &$numSplitEnv = 0) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Merge_sort
	}
	
	/**
	 * Quick Sort works in big-theta(n log n) time on average, though in the worst case, it
	 * will operate in big-theta(n^2) time. This method aims for a 3 to 1 split by taking
	 * the median value of a random sampling of values from $array. As the sampling period
	 * takes extra work, set the $minArraySize to the smallest array to take a sampling from.
	 * Anything less than the specified array width will not using sampling.
	 * 
	 * This algorithm is designed to improve on the performance of PHP's sort(), such that it
	 * gives you better speed control through the use of random sampling.
	 * 
	 * NOTE: Leave $numRandom at -1 to allow the algorithm to determine the optimum number of
	 * values to sample based on the width of the array at the current recursion level.
	 * 
	 * @param array $vector			The Vector to sort
	 * @param integer $pivot		The index to use as the pivot (Or leave at null)
	 * @param integer $numRandom	The number of random elements to sample for each iteration (See above notes)
	 * @param integer $minArraySize	The minimum array width to pull samples from
	 */
	public static function quickSort(Vector<int> $vector, ?int $pivot = null, int $numRandom = -1, int $minArraySize = null) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Quicksort
	}
	
	public static function intelligentSort(Vector<int> $vector) : Vector<int>
	{
		// Guess at which sorting algorithm to use.
	}
	
	public static function heapSort(Vector<int> $vector) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Heapsort
	}
	
	public static function bucketSort(Vector<int> $vector, int $buckets) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Bucket_sort
	}
	
	public static function countingSort(Vector<int> $vector, int $maxValue) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Counting_sort
	}
	
	public static function radixSort(Vector<int> $vector)
	{
		// https://en.wikipedia.org/wiki/Radix_sort
		// https://www.codingbot.net/2013/02/radix-sort-algorithm-and-c-code.html
	}
}
