<?HH

class SortTest extends \PHPUnit_Framework_TestCase
{
	public function testSelectionSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::selectionSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testBubbleSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::bubbleSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testInsertSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::insertSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testInsertSortWithOffsets()
	{
		$unsorted = Vector{5,4,8,4,0,-1,1,7,3};
		$sorted = Vector{5,4,8,-1,0,1,4,7,3};
		$result = \HackFastAlgos\Sort::insertSort($unsorted, 3, 6);
		$this->assertEquals($sorted, $result);
	}

	public function testShellSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::shellSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testHeapSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::heapSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testFyShuffle()
	{
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$sortedClone = clone $sorted;
		$result = \HackFastAlgos\Sort::fyShuffle($sorted);
		$this->assertFalse($result == $sortedClone);
	}
}
