<?HH

class SearchTest extends \PHPUnit_Framework_TestCase
{
	public function testCanLocateItemUsingBinarySearch()
	{
		$vector = Vector{-1,0,1,2,3,4,5,6,7,8,9,10};
		$result = \HackFastAlgos\Search::binarySearch($vector, 3);

		$this->assertSame(4, $result);
	}

	public function testCanNotLocateItemUsingBinarySearchWhenItDoesNotExist()
	{
		$vector = Vector{-1,0,1,2,3,4,5,6,7,8,9,10};
		$result = \HackFastAlgos\Search::binarySearch($vector, 500);

		$this->assertSame(-1, $result);
	}

	public function testCanLocateItemUsingBruteForceSearch()
	{
		$vector = Vector{-1,0,1,2,3,4,5,6,7,8,9,10};
		$result = \HackFastAlgos\Search::bruteForceSearch($vector, 3);

		$this->assertSame(4, $result);
	}

	public function testCanNotLocateItemUsingBruteForceSearchWhenItDoesNotExist()
	{
		$vector = Vector{-1,0,1,2,3,4,5,6,7,8,9,10};
		$result = \HackFastAlgos\Search::bruteForceSearch($vector, 500);

		$this->assertSame(-1, $result);
	}
}
