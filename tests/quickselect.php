<?HH

class QuickSelectTest extends \PHPUnit_Framework_TestCase
{
	public function testCanFindNthSmallestNumberInAVector()
	{
		$testSubject = Vector{1,7,23,2,6,8,658,1,0,-1,5};
		$qs = new \HackFastAlgos\QuickSelect($testSubject);

		$this->assertSame(5, $qs->quickSelect(5));
	}

	public function testCanFindTheSmallestNumber()
	{
		$testSubject = Vector{1,7,23,2,6,8,658,1,0,-1,5};
		$qs = new \HackFastAlgos\QuickSelect($testSubject);

		$this->assertSame(-1, $qs->quickSelect(0));
	}
}
