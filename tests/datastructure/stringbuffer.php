<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class StringBufferTest extends \PHPUnit_Framework_TestCase
{
	public function testCanAppendStringsToABufferAndPrintTheResult()
	{
		$buffer = new DataStructure\StringBuffer();

		$this->assertSame('', (string) $buffer);

		$buffer->append('test');
		$this->assertSame('test', (string) $buffer);

		$buffer->append('is valid');
		$this->assertSame('testis valid', (string) $buffer);

		$buffer->append(' again');
		$this->assertSame('testis valid again', (string) $buffer);
	}
}
