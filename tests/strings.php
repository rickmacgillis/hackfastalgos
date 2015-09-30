<?hh

class StringsTest extends \PHPUnit_Framework_TestCase
{
	public function testEmptyStringIsAPalindrome()
	{
		$result = \HackFastAlgos\Strings::isPalindrome('');
		$this->assertTrue($result);
	}

	public function testOneLetterIsAPalindrome()
	{
		$result = \HackFastAlgos\Strings::isPalindrome('a');
		$this->assertTrue($result);
	}

	public function testReturnsTrueForEvenLengthPalindrome()
	{
		$result = \HackFastAlgos\Strings::isPalindrome('qwertyuioppoiuytrewq');
		$this->assertTrue($result);
	}

	public function testReturnsTrueForOddLengthPalindrome()
	{
		$result = \HackFastAlgos\Strings::isPalindrome('qwertyuiopoiuytrewq');
		$this->assertTrue($result);
	}

	public function testReturnsFalseWhenNotAPalindrome()
	{echo 'start';
		$result = \HackFastAlgos\Strings::isPalindrome('Patrick Script');
		$this->assertFalse($result);
	}
}
