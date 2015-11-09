<?HH

use \HackFastAlgos\Interview as Interview;

class StringRotationTest extends \PHPUnit_Framework_TestCase
{
	public function testWordIsValidRotationOfAnother()
	{
		$this->assertTrue(Interview\StringRotation::isRotationOf('erbottlewat', 'waterbottle'));
	}

	public function testThatWordIsNotAValidRotationOfAnother()
	{
		$this->assertFalse(Interview\StringRotation::isRotationOf('erbottleingwat', 'waterbottle'));
		$this->assertFalse(Interview\StringRotation::isRotationOf('crap', 'waterbottle'));
	}
}
