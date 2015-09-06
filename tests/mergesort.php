<?HH

class MergeSortTest extends \PHPUnit_Framework_TestCase
{
	public function testMergeSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$ms = new \HackFastAlgos\MergeSort($unsorted);
		$result = $ms->mergeSort();
		$this->assertEquals($sorted, $result);
	}

	public function testMergeSortAsync()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$ms = new \HackFastAlgos\MergeSort($unsorted);
		$result = $ms->mergeSort(true);
		$this->assertEquals($sorted, $result->getWaitHandle()->join());
	}
}
