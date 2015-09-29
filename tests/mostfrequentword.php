<?HH

class MostFrequentWordTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetMostFrequentWord()
	{
		$text = 'The word word must appear twice.';
		$mostFreqWord = new \HackFastAlgos\MostFrequentWord($text);
		$mostFreqWord->calculateFequency();
		$this->assertSame('word', $mostFreqWord->getMostFrequentWord());
	}

	public function testCanGetTheNumberOfTimesThatTheMostFrequentWordAppears()
	{
		$text = 'The word word must appear twice.';
		$mostFreqWord = new \HackFastAlgos\MostFrequentWord($text);
		$mostFreqWord->calculateFequency();
		$this->assertSame(2, $mostFreqWord->getWordFrequency('word'));
	}

	public function testCanExtractWords()
	{
		$text = 'The word word must must MUST appear twice.';
		$mostFreqWord = new \HackFastAlgos\MostFrequentWord($text);
		$mostFreqWord->calculateFequency();
		$this->assertSame('must', $mostFreqWord->extractWord());
		$this->assertSame('word', $mostFreqWord->extractWord());
	}

	public function testCanGetWordFrequencyAfterExtraction()
	{
		$text = 'The word word must must MUST appear twice.';
		$mostFreqWord = new \HackFastAlgos\MostFrequentWord($text);
		$mostFreqWord->calculateFequency();
		$this->assertSame('must', $mostFreqWord->extractWord());
		$this->assertSame(3, $mostFreqWord->getWordFrequency('must'));
	}
}
