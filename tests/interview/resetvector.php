<?HH

use \HackFastAlgos\Interview as Interview;

class ResetVectorTest extends \PHPUnit_Framework_TestCase
{
	public function testCanFindResetPointInRangeVector()
	{
		$vector = Vector{6,7,8,9,0,1,2,3,4,5};
		$this->assertSame(4, Interview\ResetVector::findResetPointInRangeVector($vector));

		$vector = Vector{5,6,7,8,9,0,1,2,3,4};
		$this->assertSame(5, Interview\ResetVector::findResetPointInRangeVector($vector));

		$vector = Vector{7,8,9,0,1,2,3,4,5,6};
		$this->assertSame(3, Interview\ResetVector::findResetPointInRangeVector($vector));

		$vector = Vector{0,1,2,3,4,5,6,7,8,9};
		$this->assertSame(0, Interview\ResetVector::findResetPointInRangeVector($vector));

		$vector = Vector{1,2,3,4,5,6,7,8,9,0};
		$this->assertSame(9, Interview\ResetVector::findResetPointInRangeVector($vector));

		$vector = Vector{1,2,3,4,5,6,7,8,9,-1,0};
		$this->assertSame(9, Interview\ResetVector::findResetPointInRangeVector($vector));
	}
}
