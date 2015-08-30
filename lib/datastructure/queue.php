<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 * 
 * Implementation of a queue
 * @Learn more @link https://en.wikipedia.org/wiki/Queue_(abstract_data_type)
 */

namespace HackFastAlgos\DataStructure;

class QueueException extends \Exception{}

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
	 * @param $manual Set this to true if you wish to manually shift the queue instead of using array_shift
	 * @return T The item from the queue
	 */
	public function dequeue<T>(bool $manual = false) : T
	{
		if (empty($this->queueData)) {
			throw new QueueException('Invalid index');
		}
		
		// Usually we use array_shift(), though for completion's sake, we'll manually shift the queue.
		if (true === $manual) {

			$count = count($this->queueData);
			$first = $this->queueData[0];
			
			// Re-index the queue
			$k = 0;
			$newQueue = [];
			for ($i = 1; $i < $count; $i++) {
				$newQueue[$k++] = $this->queueData[$i];
			}
			
			$this->queueData = $newQueue;
			return $first;
			
		}
		
		return array_shift($this->queueData);
	}
}
