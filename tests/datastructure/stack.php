<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class StackTest extends \PHPUnit_Framework_TestCase
{
	public function testPush()
	{
		$stack = new DataStructure\Stack;
		$stack->push('a');
	}

	public function testCount()
	{
		$stack = new DataStructure\Stack;
		$stack->push('a');

		$this->assertSame(1, $stack->count());
	}

	public function testPop()
	{
		$stack = new DataStructure\Stack;
		$stack->push('a');
		$stack->push('b');
		$stack->push('c');

		$this->assertSame('c', $stack->pop());
		$this->assertSame('b', $stack->pop());
		$this->assertSame('a', $stack->pop());

		// Bad index.
		try {

			$stack->pop();
			$this->fail();

		} catch (DataStructure\StackInvalidIndexException $e) {}
	}
}
