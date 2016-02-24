<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of Bucket Sort
 * Bucket sort works best for numbers in a known range due to how the bucket index is calculated.
 * For the same reason, Bucket Sort is not useful for a mixture of signed and unsigned numbers.
 *
 * Learn more @link https://en.wikipedia.org/wiki/Bucket_sort
 * @link http://www.geeksforgeeks.org/bucket-sort-2/
 */

namespace HackFastAlgos;

class BucketSort
{
	private array $buckets = [];

	public function __construct(private array $input, private int $totalBuckets){}

	public function sort() : array
	{
		$this->placeNumbersInBuckets();
		$this->sortAllBuckets();
		$this->moveBucketDataBackToOriginalArray();

		return $this->input;
	}

	private function placeNumbersInBuckets()
	{
		$inputLength = count($this->input);
		for ($i = 0; $i < $inputLength; $i++) {

			$bucket = $this->input[$i] * $this->totalBuckets;
			$this->addNumberToBucketAtIndex($this->input[$i], (int) $bucket);

		}
	}

	private function addNumberToBucketAtIndex(float $number, int $bucketIndex)
	{
		if ($this->isBucketEmpty($bucketIndex) === true) {
			$this->buckets[$bucketIndex] = [];
		}

		array_push($this->buckets[$bucketIndex], $number);
	}

	private function isBucketEmpty(int $bucketIndex) : bool
	{
		return array_key_exists($bucketIndex, $this->buckets) === false;
	}

	private function sortAllBuckets()
	{
		for ($i = 0; $i <= $this->totalBuckets; $i++) {
			if ($this->doesBucketHaveMoreThanOneItem($i) === true) {
				$this->sortBucket($i);
			}
		}
	}

	private function doesBucketHaveMoreThanOneItem(int $bucketIndex) : bool
	{
		return $this->isBucketEmpty($bucketIndex) === false && count($this->buckets[$bucketIndex]) > 1;
	}

	private function sortBucket(int $bucketIndex)
	{
		$this->buckets[$bucketIndex] = Sort::insertSort($this->buckets[$bucketIndex]);
	}

	private function moveBucketDataBackToOriginalArray()
	{
		$moveToIndex = 0;
		for ($i = 0; $i <= $this->totalBuckets; $i++) {

			if ($this->isBucketEmpty($i) === false) {

				$bucketSize = count($this->buckets[$i]);
				for ($j = 0; $j < $bucketSize; $j++) {
					$this->input[$moveToIndex++] = $this->buckets[$i][$j];
				}

			}

		}
	}
}
