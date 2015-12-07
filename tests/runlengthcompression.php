<?HH

class RunLengthCompressionTest extends \PHPUnit_Framework_TestCase
{
	private String $rawRun = '11111111111111100000000000111100000000000001100000000000000011111111110';
	private String $encodedRun = '0 15 11 4 13 2 15 10 1';

	public function testCanRunLengthEncodeString()
	{
		$compression = new \HackFastAlgos\RunLengthCompression($this->rawRun);
		$this->assertSame($this->encodedRun, $compression->encode());
	}

	public function testCanRunLengthDecodeString()
	{
		$compression = new \HackFastAlgos\RunLengthCompression($this->encodedRun);
		$this->assertSame($this->rawRun, $compression->decode());
	}

	public function testWillThrowExceptionWhenNonBinaryString()
	{
		$compression = new \HackFastAlgos\RunLengthCompression('120');
		try {
			$compression->encode();
			$this->fail();
		} catch (\HackFastAlgos\RunLengthCompressionNotBinaryStringException $e) {}

		$compression = new \HackFastAlgos\RunLengthCompression('Not Binary');
		try {
			$compression->encode();
			$this->fail();
		} catch (\HackFastAlgos\RunLengthCompressionNotBinaryStringException $e) {}
	}
}
