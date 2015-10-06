<?HH

class QuickSortTest extends \PHPUnit_Framework_TestCase
{
	public function testCanQuickSort()
	{
		$vector = Vector{3,86,2,9,6,1,55,1,0,-1};
		$qs = new \HackFastAlgos\QuickSort($vector);
		$qs->sort();

		$expected = Vector{-1,0,1,1,2,3,6,9,55,86};
		$this->assertEquals($expected, $qs->getResult());
	}
}
