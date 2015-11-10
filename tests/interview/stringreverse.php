<?HH

use \HackFastAlgos\Interview as Interview;

class StringReverseTest extends \PHPUnit_Framework_TestCase
{
	public function testCanReverseAString()
	{
		$strrev = new Interview\StringReverse('abcdefg');
		$this->assertSame('gfedcba', $strrev->reverse());
	}
}
