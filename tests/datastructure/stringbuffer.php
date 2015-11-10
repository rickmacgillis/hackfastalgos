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

	public function testCanEmteyTheBuffer()
	{
		$buffer = new DataStructure\StringBuffer();

		$this->assertSame('', (string) $buffer);

		$buffer->append('test');
		$this->assertSame('test', (string) $buffer);

		$buffer->reset();
		$this->assertSame('', (string) $buffer);
	}

	public function testCanCheckIfBufferIsEmpty()
	{
		$buffer = new DataStructure\StringBuffer();

		$this->assertSame('', (string) $buffer);
		$this->assertTrue($buffer->isEmpty());

		$buffer->append('test');
		$this->assertFalse($buffer->isEmpty());

		$buffer->reset();
		$this->assertTrue($buffer->isEmpty());
	}
}
