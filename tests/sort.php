<?HH

class SortTest extends PHPUnit_Framework_TestCase
{
	public function testSelectionSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::selectionSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testInsertSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::insertSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testBubbleSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::bubbleSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testMergeSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::mergeSort($unsorted);
		$this->assertEquals($sorted, $result);
	}

	public function testMergeSortAsync()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::mergeSort($unsorted, true);
		$this->assertEquals($sorted, $result->getWaitHandle()->join());
	}
}
