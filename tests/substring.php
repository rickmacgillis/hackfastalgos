<?HH

class SubStringTest extends \PHPUnit_Framework_TestCase
{
	private string $needle = 'AAABBCCDDDDDAAB';
	private string $haystack = 'AAAAAAAAAAAABBBBDDCBADAAABBCCDDDDDAABAAABBDD';

	private string $badNeedle = 'Crap';
	private string $badHaystack = 'Today I took a very large... bite of pizza.';

	public function testCanFindPositionOfNeedleUsingBruteVersion1()
	{
		$substring = new \HackFastAlgos\SubString($this->needle, $this->haystack);
		$this->assertSame(22, $substring->bruteForceVersion1());
	}

	public function testWillThrowExceptionWhenStringNotFoundOnBruteForceVersion1()
	{
		$substring = new \HackFastAlgos\SubString($this->badNeedle, $this->badHaystack);

		try {
			$substring->bruteForceVersion1();
			$this->fail();
		} catch (\HackFastAlgos\SubStringStringNotFoundException $e) {}
	}

	public function testCanFindPositionOfNeedleUsingBruteForceVersion2()
	{
		$substring = new \HackFastAlgos\SubString($this->needle, $this->haystack);
		$this->assertSame(22, $substring->bruteForceVersion2());
	}

	public function testWillThrowExceptionWhenStringNotFoundOnBruteForceVersion2()
	{
		$substring = new \HackFastAlgos\SubString($this->badNeedle, $this->badHaystack);

		try {
			$substring->bruteForceVersion2();
			$this->fail();
		} catch (\HackFastAlgos\SubStringStringNotFoundException $e) {}
	}

	public function testCanFindPositionOfNeedleUsingKmpSearch()
	{
		$substring = new \HackFastAlgos\SubString($this->needle, $this->haystack);
		$this->assertSame(22, $substring->kmpSearch());
	}

	public function testWillThrowExceptionWhenStringNotFoundOnKmpSearch()
	{
		$substring = new \HackFastAlgos\SubString($this->badNeedle, $this->badHaystack);

		try {
			$substring->kmpSearch();
			$this->fail();
		} catch (\HackFastAlgos\SubStringStringNotFoundException $e) {}
	}

	public function testCanFindPositionOfNeedleUsingKmpSearchImproved()
	{
		$substring = new \HackFastAlgos\SubString($this->needle, $this->haystack);
		$this->assertSame(22, $substring->kmpSearchImproved());
	}

	public function testWillThrowExceptionWhenStringNotFoundOnKmpSearchImproved()
	{
		$substring = new \HackFastAlgos\SubString($this->badNeedle, $this->badHaystack);

		try {
			$substring->kmpSearchImproved();
			$this->fail();
		} catch (\HackFastAlgos\SubStringStringNotFoundException $e) {}
	}
}
