<?HH

use \HackFastAlgos\interview as Interview;

class CompressStringTest extends \PHPUnit_Framework_TestCase
{
	public function testCanCompressString()
	{
		$compressor = new Interview\CompressString('aaabbcccccccddefghhhh');
		$this->assertSame('a3b2c7d2e1f1g1h4', $compressor->compress());
	}

	public function testCanGetOriginalStringWhenCompressionIsLonger()
	{
		$compressor = new Interview\CompressString('abcdefgh');
		$this->assertSame('abcdefgh', $compressor->compress());
	}
}
