<?HH

use \HackFastAlgos\Interview as Interview;

class ReplaceCharTest extends \PHPUnit_Framework_TestCase
{
	public function testCanReplaceSpacesWithPercentTwenty()
	{
		$replaceChar = new Interview\ReplaceChar('You\'re a what.');
		$this->assertSame('You\'re%20a%20what.', $replaceChar->replace(' ', '%20'));

		$replaceChar = new Interview\ReplaceChar(' You\'re a what.');
		$this->assertSame('%20You\'re%20a%20what.', $replaceChar->replace(' ', '%20'));

		$replaceChar = new Interview\ReplaceChar(' You\'re a what. ');
		$this->assertSame('%20You\'re%20a%20what.%20', $replaceChar->replace(' ', '%20'));

		$replaceChar = new Interview\ReplaceChar('You\'re a what. ');
		$this->assertSame('You\'re%20a%20what.%20', $replaceChar->replace(' ', '%20'));

		$replaceChar = new Interview\ReplaceChar('Nospace');
		$this->assertSame('Nospace', $replaceChar->replace(' ', '%20'));
	}
}
