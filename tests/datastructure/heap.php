<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class HeapTest extends \PHPUnit_Framework_TestCase
{
	public function testThrowsExceptionOnExtractionFromEmptyHeap()
	{
		$heap = new DataStructure\Heap();
		try {
			$heap->extract();
			$this->fail();
		} catch (DataStructure\HeapEmptyException $e){}
	}

	public function testCanExtractOneItemFromMinHeap()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(1);
		$this->assertSame(1, $heap->extract());
	}

	public function testCanGetHeapSize()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(1);
		$this->assertSame(1, $heap->count());
	}

	public function testCanHeapify()
	{
		$heap = new DataStructure\Heap();
		$items = Vector{1,3,2};
		$heap->heapify($items);
		$this->assertSame(3, $heap->count());
	}

	public function testCanCheckIfHeapIsEmpty()
	{
		$heap = new DataStructure\Heap();
		$this->assertTrue($heap->isEmpty());
		$heap->insert(1);
		$this->assertFalse($heap->isEmpty());
	}

	public function testThrowsExceptionOnGetMinForMaxHeap()
	{
		$heap = new DataStructure\Heap(DataStructure\Heap::MAX_HEAP);
		try {
			$heap->getMin();
			$this->fail();
		} catch (DataStructure\HeapNotMinHeapException $e) {}
	}

	public function testThrowsExceptionOnGetMaxForMinHeap()
	{
		$heap = new DataStructure\Heap();
		try {
			$heap->getMax();
			$this->fail();
		} catch (DataStructure\HeapNotMaxHeapException $e) {}
	}

	public function testThrowsExceptionWhenHeapifyingAfterInserting()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(1);
		try {
			$heap->heapify(Vector{1,2,3});
			$this->fail();
		} catch (DataStructure\HeapNotEmptyException $e) {}
	}

	public function testThrowsExceptionWhenDeletingFromEmptyHeap()
	{
		$heap = new DataStructure\Heap();
		try {
			$heap->delete(1);
			$this->fail();
		} catch (DataStructure\HeapEmptyException $e) {}
	}

	public function testCanDeleteFromHeap()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(1);
		$heap->delete(1);
		$this->assertTrue($heap->isEmpty());

		$heap->insert(1);
		$heap->insert(2);
		$heap->insert(3);
		$heap->delete(2);
		$this->assertSame(2, $heap->count());
	}

	public function testCanGetMinValueFromMinHeap()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(3);
		$heap->insert(1);
		$heap->insert(2);

		$this->assertSame(1, $heap->getMin());
	}

	public function testCanGetMaxValueFromMaxHeap()
	{
		$heap = new DataStructure\Heap(DataStructure\Heap::MAX_HEAP);
		$heap->insert(2);
		$heap->insert(3);
		$heap->insert(1);

		$this->assertSame(3, $heap->getMax());
	}

	public function testCanResetHeap()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(3);
		$heap->insert(1);
		$heap->insert(2);
		$heap->reset();

		$this->assertTrue($heap->isEmpty());
	}

	public function testMinHeapAlwaysReturnsMinimum()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(4);
		$heap->insert(2);
		$heap->insert(3);
		$heap->insert(1);

		$this->assertSame(1, $heap->extract());
		$this->assertSame(2, $heap->extract());
		$this->assertSame(3, $heap->extract());
		$this->assertSame(4, $heap->extract());
	}

	public function testMaxHeapAlwaysReturnsMaximum()
	{
		$heap = new DataStructure\Heap(DataStructure\Heap::MAX_HEAP);
		$heap->insert(1);
		$heap->insert(3);
		$heap->insert(2);
		$heap->insert(4);

		$this->assertSame(4, $heap->extract());
		$this->assertSame(3, $heap->extract());
		$this->assertSame(2, $heap->extract());
		$this->assertSame(1, $heap->extract());
	}

	public function testCanDeleteItemsWhileMaintainingIntegrity()
	{
		$heap = new DataStructure\Heap();
		$heap->insert(4);
		$heap->insert(2);
		$heap->insert(3);
		$heap->insert(1);
		$heap->insert(5);

		$heap->delete(2);

		$this->assertSame(1, $heap->extract());

		$heap->delete(3);
		$heap->delete(5);

		$this->assertSame(4, $heap->extract());
	}
}
