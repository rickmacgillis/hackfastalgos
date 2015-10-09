<?HH
/**
 * @author Rick Mac Gillis
 *
 * Algorithm to find the median in an integer stream using two heaps
 */

namespace HackFastAlgos;

class MedianHeap
{
	const int MEDIANHEAP_AVG = 0;
	const int MEDIANHEAP_LOW = 1;
	const int MEDIANHEAP_HIGH = 2;

	private ?DataStructure\Heap $maxHeap = null;
	private ?DataStructure\Heap $minHeap = null;

	private int $equalHeapResolution = 0;

	public function __construct()
	{
		$this->maxHeap = new DataStructure\Heap(DataStructure\Heap::MAX_HEAP);
		$this->minHeap = new DataStructure\Heap();
	}

	public function useAverageForEqualHeaps()
	{
		$this->equalHeapResolution = static::MEDIANHEAP_AVG;
	}

	public function useLowForEqualHeaps()
	{
		$this->equalHeapResolution = static::MEDIANHEAP_LOW;
	}

	public function useHighForEqualHeaps()
	{
		$this->equalHeapResolution = static::MEDIANHEAP_HIGH;
	}

	public function heapify(Vector<int> $vector)
	{
		foreach ($vector as $item) {
			$this->insert($item);
		}
	}

	public function insert(int $value)
	{
		if ($this->maxHeap->isEmpty() === true) {
			$this->maxHeap->insert($value);
		} else if ($this->minHeap->isEmpty() === true) {
			$this->minHeap->insert($value);
		} else if ($value > $this->maxHeap->getMax()) {
			$this->minHeap->insert($value);
		} else if ($value < $this->minHeap->getMin()) {
			$this->maxHeap->insert($value);
		}
	}

	public function getMedian() : int
	{
		$this->balanceHeaps();

		if ($this->maxHeap->count() > $this->minHeap->count()) {
			return $this->maxHeap->extract();
		}

		return $this->getMedianFromEqualHeaps();
	}

	private function balanceHeaps()
	{
		while ($this->maxHeap->count() > $this->minHeap->count()) {
			$this->minHeap->insert($this->maxHeap->extract());
		}

		while ($this->minHeap->count() > $this->maxHeap->count()) {
			$this->maxHeap->insert($this->minHeap->extract());
		}
	}

	private function getMedianFromEqualHeaps() : int
	{
		$firstNum = $this->maxHeap->extract();
		$secondNum = $this->minHeap->extract();

		switch ($this->equalHeapResolution) {
			case static::MEDIANHEAP_AVG:
				return (int)(($firstNum+$secondNum) / 2);
				break;

			case static::MEDIANHEAP_LOW:
				return $firstNum;

			case static::MEDIANHEAP_HIGH:
				return $secondNum;
		}
	}
}
