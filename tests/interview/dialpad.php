<?HH

class DialPadTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetDialpadCombos()
	{
		$expected = [
			'-cd', '-bd', '-ad',
			'-ce', '-be', '-ae',
			'-cf', '-bf', '-af',
		];

		$dialpad = new \HackFastAlgos\Interview\DialPad('023');
		$this->assertEquals($expected, $dialpad->getDialPadCombos());
	}
}
