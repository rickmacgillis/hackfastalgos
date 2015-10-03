<?HH

class MedianHeapTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetAverageMedianWhenEvenNumberOfItems()
	{
		$items = Vector{2,4,6,8,10,12,14,16,18,20};
		$medianHeap = new \HackFastAlgos\MedianHeap();
		$medianHeap->useAverageForEqualHeaps();
		$medianHeap->heapify($items);

		$this->assertSame(11, $medianHeap->getMedian());
	}

	public function testCanGetHigherMedianValueWhenEvenNumberOfItems()
	{
		$items = Vector{2,4,6,8,10,12,14,16,18,20};
		$medianHeap = new \HackFastAlgos\MedianHeap();
		$medianHeap->useHighForEqualHeaps();
		$medianHeap->insert(2);
		$medianHeap->insert(4);
		$medianHeap->insert(6);
		$medianHeap->insert(8);
		$medianHeap->insert(10);
		$medianHeap->insert(12);
		$medianHeap->insert(14);
		$medianHeap->insert(16);
		$medianHeap->insert(18);
		$medianHeap->insert(20);

		$this->assertSame(12, $medianHeap->getMedian());
	}

	public function testCanGetLowerMedianValueWhenEvenNumberOfItems()
	{
		$items = Vector{2,4,6,8,10,12,14,16,18,20};
		$medianHeap = new \HackFastAlgos\MedianHeap();
		$medianHeap->useLowForEqualHeaps();
		$medianHeap->heapify($items);

		$this->assertSame(10, $medianHeap->getMedian());
	}

	public function testCanGetMedian()
	{
		$items = Vector{2,6,8,10,33,66,88};
		$medianHeap = new \HackFastAlgos\MedianHeap();
		$medianHeap->useLowForEqualHeaps();
		$medianHeap->heapify($items);

		$this->assertSame(10, $medianHeap->getMedian());
	}
}
