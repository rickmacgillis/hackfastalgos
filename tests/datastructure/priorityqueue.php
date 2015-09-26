<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class PriorityQueueTest extends \PHPUnit_Framework_TestCase
{
	public function testCanAddAndRetrivePrioritizedItems()
	{
		$pq = new DataStructure\PriorityQueue();
		$pq->enqueue(Vector{1}, 1.0);
		$pq->enqueue(Vector{'a'}, 3.0);
		$pq->enqueue(Vector{'c'}, 3.0);
		$pq->enqueue(Vector{'b'}, 2.0);

		$this->assertEquals(Vector{'a'}, $pq->dequeue());
		$this->assertEquals(Vector{'c'}, $pq->dequeue());
		$this->assertEquals(Vector{'b'}, $pq->dequeue());
		$this->assertEquals(Vector{1}, $pq->dequeue());
	}

	public function testCanGetMaxItem()
	{
		$pq = new DataStructure\PriorityQueue();
		$pq->enqueue(Vector{1}, 1.0);
		$pq->enqueue(Vector{'a'}, 3.0);

		$this->assertEquals(Vector{'a'}, $pq->getMax());
	}
}
