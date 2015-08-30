<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 * 
 * Implementation of a priority queue
 * Learn more @link https://en.wikipedia.org/wiki/Priority_queue
 */

namespace HackFastAlgos\DataStructure;

class PriorityQueue extends Heap
{
	public function enqueue<T>(T $item, int $priority)
	{
		
	}
	
	/**
	 * Dequeue an item from the priority queue
	 * 
	 * @return T The dequeued item
	 */
	public function dequeue() : T
	{
		return $this->extract();
	}
}
