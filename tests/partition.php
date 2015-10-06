<?HH

class PartitionTest extends \PHPUnit_Framework_TestCase
{
	public function testCanPartitionAVectorAroundAGivenPivot()
	{
		$vector = Vector{3,86,2,9,6,1,55,1,0,-1};
		$partition = new \HackFastAlgos\Partition($vector);

		$expected = Vector{1,-1,2,0,1,3,55,6,9,86};
		$this->assertEquals($expected, $partition->partition());
	}

	public function testCanGetPivotPointer()
	{
		$vector = Vector{3,86,2,9,6,1,55,1,0,-1};
		$partition = new \HackFastAlgos\Partition($vector);
		$partition->partition();

		$this->assertEquals(5, $partition->getPivot());
	}
}
