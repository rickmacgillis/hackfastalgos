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
	/**
	 * The array of queue data
	 * @param array $queueData
	 */
	protected array $queueData = [];

	/**
	 * Get the number of items in the queue
	 *
	 * @return int The number of items in the queue
	 */
	public function count() : int
	{
		return count($this->queueData);
	}

	/**
	 * Enqueue an item in the queue
	 *
	 * @param T $item The item to enqueue
	 */
	public function enqueue<T>(T $item)
	{
		$this->queueData[] = $item;
	}

	/**
	 * Remove and return the first item in the queue
	 *
	 * @param $manuallyDequeue Set this to true if you wish to manually shift the queue instead of using array_shift
	 * @return T The item from the queue
	 */
	public function dequeue<T>() : T
	{
		$this->throwIfEmptyQueue();
		return array_shift($this->queueData);
	}

	/**
	 * Perform the dequeue function through Hack instead of using the built in functionality.
	 *
	 * @return T	The first item in the queue
	 */
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

	/**
	 * Throw an exception if the queue is empty
	 *
	 * @throws QueueEmptyException
	 */
	protected function throwIfEmptyQueue()
	{
		if (empty($this->queueData)) {
			throw new QueueEmptyException();
		}
	}
}
