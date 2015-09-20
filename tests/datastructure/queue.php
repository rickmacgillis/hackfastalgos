<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class QueueTest extends \PHPUnit_Framework_TestCase
{
	public function testEnqueue()
	{
		$queue = new DataStructure\Queue;
		$queue->enqueue('a');
	}

	public function testCount()
	{
		$queue = new DataStructure\Queue;
		$queue->enqueue('a');

		$this->assertSame(1, $queue->count());
	}

	public function testDequeue()
	{
		$queue = new DataStructure\Queue;
		$queue->enqueue('a');
		$queue->enqueue('b');
		$queue->enqueue('c');

		$this->assertSame('a', $queue->dequeue());
		$this->assertSame('b', $queue->manuallyDequeue());
		$this->assertSame('c', $queue->manuallyDequeue());

		try {

			$queue->dequeue();
			$this->fail();

		} catch (DataStructure\QueueEmptyException $e) {}
	}
}
