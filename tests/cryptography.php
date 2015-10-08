<?HH

class CryptographyTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetRandomNumber()
	{
		$random = \HackFastAlgos\Cryptography::getRandomNumber(0, 20);
		$this->assertInternalType('integer', $random);
		$this->assertTrue($random >= 0 && $random <= 20);
	}
}
