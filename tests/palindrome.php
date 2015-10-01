<?HH

class PalindromeTest extends \PHPUnit_Framework_TestCase
{
	public function testEmptyStringIsAPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->isPalindrome('');
		$this->assertTrue($result);
	}

	public function testOneLetterIsAPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->isPalindrome('a');
		$this->assertTrue($result);
	}

	public function testReturnsTrueForEvenLengthPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->isPalindrome('qwertyuioppoiuytrewq');
		$this->assertTrue($result);
	}

	public function testReturnsTrueForOddLengthPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->isPalindrome('qwertyuiopoiuytrewq');
		$this->assertTrue($result);
	}

	public function testReturnsFalseWhenNotAPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->isPalindrome('Patrick Script');
		$this->assertFalse($result);
	}

	public function testCanGetFirstLongestPalindromeWhenMoreThanOne()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->findLongestPalindrome('abracadabra'); // aca then ada
		$this->assertSame('aca', $result);
	}

	public function testCanGetLongestPalendromeWhenMultiplePalindromes()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->findLongestPalindrome('wowmomwow'); // Clever. ;)
		$this->assertSame('wowmomwow', $result);
	}

	public function testCanGetFirstLetterAsPalindrome()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->findLongestPalindrome('qwerty');
		$this->assertSame('q', $result);
	}

	public function testCanGetEmptyPalindromeWhenGivenEmptyString()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->findLongestPalindrome('');
		$this->assertSame('', $result);
	}

	public function testCanGetLargerPalendromeWhenAShorterOnePreceedsIt()
	{
		$pal = new \HackFastAlgos\Palindrome();
		$result = $pal->findLongestPalindrome('wowqwertytrewq');
		$this->assertSame('qwertytrewq', $result);
	}
}
