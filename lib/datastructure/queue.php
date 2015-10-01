<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a queue
 * @Learn more @link https://en.wikipedia.org/wiki/Queue_(abstract_data_type)
 */

namespace HackFastAlgos\DataStructure;

class QueueEmptyException extends \Exception{}

class Queue implements \Countable
{
	private array $queueData = [];

	public function count() : int
	{
		return count($this->queueData);
	}

	public function enqueue<T>(T $item)
	{
		$this->queueData[] = $item;
	}

	public function dequeue<T>() : T
	{
		$this->throwIfEmptyQueue();
		return array_shift($this->queueData);
	}

	public function manuallyDequeue<T>() : T
	{
		$this->throwIfEmptyQueue();

		$count = count($this->queueData);
		$first = array_key_exists(0, $this->queueData) ? $this->queueData[0] : null;

		// Re-index the queue
		$k = 0;
		$newQueue = [];
		for ($i = 1; $i < $count; $i++) {
			$newQueue[$k++] = $this->queueData[$i];
		}

		$this->queueData = $newQueue;
		return $first;
	}

	protected function throwIfEmptyQueue()
	{
		if (empty($this->queueData)) {
			throw new QueueEmptyException();
		}
	}
}
