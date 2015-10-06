<?HH

class AlgosTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetRandomNumber()
	{
		$random = \HackFastAlgos\Algos::getRandomNumber(0, 20);
		$this->assertInternalType('integer', $random);
		$this->assertTrue($random >= 0 && $random <= 20);
	}
}
