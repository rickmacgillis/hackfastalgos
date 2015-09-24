<?HH

class PolishNotationTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetAFloatFromPolishPrefixNotation()
	{
		$polishNotation = '- * / 15 - 7 + 1 1 3 + 2 + 1 -1';
		$pn = new \HackFastAlgos\PolishNotation($polishNotation);
		$this->assertSame(7.0, $pn->toFloat());
	}
}
