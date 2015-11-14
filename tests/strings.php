<?HH

class StringsTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetSuffixArray()
	{
		$result = \HackFastAlgos\Strings::suffixArray('banana');
		$expected = Vector{
			'banana',
			'anana',
			'nana',
			'ana',
			'na',
			'a',
		};

		$this->assertEquals($expected, $result);

		$result = \HackFastAlgos\Strings::suffixArray('');
		$this->assertEquals(Vector{''}, $result);
	}

	public function testCanFindLongestPrefixOfTwoStrings()
	{
		$result = \HackFastAlgos\Strings::longestPrefix('myshorts', 'myshlacks');
		$this->assertSame('mysh', $result);
	}

	public function testreturnsEmptyStringWhentwoStringsStartWithDifferentChars()
	{
		$result = \HackFastAlgos\Strings::longestPrefix('amyshorts', 'bmyshlacks');
		$this->assertSame('', $result);
	}

	public function testCanFindTheLongestRepeatedSubstring()
	{
		$result = \HackFastAlgos\Strings::longestRepeatedSubstring('wowowmomowowowow');
		$this->assertSame('owowow', $result);
	}
}
