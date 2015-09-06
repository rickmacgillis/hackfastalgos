<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 * 
 * Implementation of a job scheduler
 */

namespace HackFastAlgos\DataStructure;

class Schedule
{
	/**
	 * The scheduled events as a priority queue
	 * @var PriorityQueue $scheduledEvents
	 */
	protected PriorityQueue $scheduledEvents = new PriorityQueue;
	
	/**
	 * Insert a task into the scheduler.
	 * 
	 * @param T $task		The identifier for the task
	 * @param int $length	A numerical representation of how long the task takes to run (Higher = slower)
	 * @param int $weight	The priority of the task (Higher = more important)
	 */
	public function insert<T>(T $task, int $length, int $weight)
	{
		$this->scheduledEvents->enqueue($task, ($weight/$length));
	}
	
	/**
	 * Extract a task
	 * 
	 * @return T The identifier for the task
	 */
	public function extract<T>() : T
	{
		return $this->scheduledEvents->dequeue();
	}
	
	/**
	 * Delete a task
	 * 
	 * @param T $task The task identifier to delete
	 */
	public function delete<T>(T $task)
	{
		$this->scheduledEvents->delete();
	}
}
