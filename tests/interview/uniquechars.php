<?HH

use \HackFastAlgos\Interview as Interview;

class UniqueCharsTest extends \PHPUnit_Framework_TestCase
{
	public function testUniqueCharacterStringIsAUniqueCharacterString()
	{
		$this->assertTrue(Interview\UniqueChars::areUnique('abcdefg'));
	}

	public function testNotUniqueCharacterStringIsNotAUniqueCharacterString()
	{
		$this->assertFalse(Interview\UniqueChars::areUnique('aabcdefg'));
		$this->assertFalse(Interview\UniqueChars::areUnique('abcdefgg'));
		$this->assertFalse(Interview\UniqueChars::areUnique('abccdefg'));
		$this->assertFalse(Interview\UniqueChars::areUnique('abbcdefg'));
	}
}
