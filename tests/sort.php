<?HH

class SortTest extends PHPUnit_Framework_TestCase
{
	public function testSelectionSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::selectionSort($unsorted, function($a, $b){
			return static::compareCallback($a, $b);
		});
		$this->assertEquals($sorted, $result);
	}

	public function testBubbleSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::bubbleSort($unsorted, function($a, $b){
			return static::compareCallback($a, $b);
		});
		$this->assertEquals($sorted, $result);
	}

	public function testInsertSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::insertSort($unsorted, function($a, $b){
			return static::compareCallback($a, $b);
		});
		$this->assertEquals($sorted, $result);
	}

	public function testMergeSort()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::mergeSort($unsorted, function($a, $b){
			return static::compareCallback($a, $b);
		});
		$this->assertEquals($sorted, $result);
	}

	public function testMergeSortAsync()
	{
		$unsorted = Vector{5,4,8,1,0,-1,4,7,3};
		$sorted = Vector{-1,0,1,3,4,4,5,7,8};
		$result = \HackFastAlgos\Sort::mergeSort($unsorted, function($a, $b){
			return static::compareCallback($a, $b);
		}, true);
		$this->assertEquals($sorted, $result->getWaitHandle()->join());
	}
	
	protected static function compareCallback($a, $b)
	{
		if ($a > $b) {
			return 1;
		} elseif ($a < $b){
			return -1;
		} else {
			return 0;
		}
	}
}
